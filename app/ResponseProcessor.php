<?php

namespace App;

use Carbon\Carbon;
use GuzzleHttp\TransferStats;
use Spatie\SslCertificate\SslCertificate;
use Spatie\SslCertificate\Exceptions\CouldNotDownloadCertificate;

use Illuminate\Support\Facades\Mail;
use App\Mail\ResponseFail\Warning;
use App\Mail\ResponseFail\Stop;
use App\Mail\CertificateFail;

use App\Downtime;
use App\Attempt;

class ResponseProcessor
{
    protected $site;
    
    public function __construct(Site $site)
    {
        $this->site = $site;
    }

    //Process response
    public function process(TransferStats $statistics)
    {
        $response = $statistics->getResponse();

        //Check if there is a response
        if($response != null){

            //Check if it's a good or a bad response
            if ($response->getStatusCode() < 300) {

                $this->goodResponse();

            } elseif ($response->getStatusCode() >= 400) {

                $this->badResponse();

            }

            //Save attempt
            Attempt::create([
                'site_id' => $this->site->id,
                'status' => $response->getStatusCode(),
                'load_time' => $statistics->getTransferTime(),
                'message' => $response->getReasonPhrase(),
                'certificate_validity' => $this->getCertificateValidity()
            ]);

        } else {

            $this->badResponse();

            //Save attempt
            Attempt::create([
                'site_id' => $this->site->id,
                'status' => null,
                'load_time' => $statistics->getTransferTime(),
                'message' => null,
                'certificate_validity' => $this->getCertificateValidity()
            ]);
        }

    }

    //Respond to a bad response
    public function badResponse()
    {
        //Set attempt counter
        $this->site->tried++;

        //Set down_from
        if ($this->site->down_from == null) {
            $this->site->down_from = Carbon::now();
        }

        $this->site->save();

        //If it's needed send a notification
        $this->sendEmailIfNeeded();
    }

    public function goodResponse()
    {
        //Reset attempt counter
        $this->site->tried = 0;

        //Reset down_from and create downtime record
        if ($this->site->down_from != null) {

            Downtime::create([
                'site_id' => $this->site->id,
                'start_at' => $this->site->down_from,
                'end_at' => Carbon::now()
            ]);

            $this->site->down_from = null;
        }

        $this->site->save();
    }

    public function sendEmailIfNeeded()
    {
        //Get addresses
        $addresses = $this->site->emails->pluck('address')->toArray();

        //Testing emails
        $addresses[] = 'admin@admin.com';

        //Chek if notification is needed and send
        if($this->site->tried % config('check.mail.response_attempts_to_notificate') == 0
            && $this->site->tried < config('check.mail.response_attempts_to_stop'))
        {

            Mail::to($addresses)->send(new Warning($this->site));

        }
        if ($this->site->tried == config('check.mail.response_attempts_to_stop')) {

            Mail::to($addresses)->send(new StopChecking($this->site));

        }

        if ($this->site->certificate_attempts == config('check.mail.certificate_attempts_to_notificate')) {

            Mail::to($addresses)->send(new CertificateCheckFail($this->site));

        }
    }

    //Return the certificate validity if the site must be certificated
    public function getCertificateValidity()
    {
        if($this->site->check_certificate){

            try {

                $certificatValidity = SslCertificate::createForHostName($this->site->url)->isValid();

                //Set certificate_attempts
                if ($certificatValidity) {
                    $this->site->certificate_attempts = 0;
                } else {
                    $this->site->certificate_attempts++;
                }
                $this->site->save();


                return $certificatValidity;

            } catch (CouldNotDownloadCertificate $exception) {

                $this->site->certificate_attempts++;
                $this->site->save();

                return false;

            }

        }

        return null;
    }
}

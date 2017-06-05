<?php

namespace App\Checker;

use Carbon\Carbon;
use GuzzleHttp\TransferStats;
use Spatie\SslCertificate\SslCertificate;
use Spatie\SslCertificate\Exceptions\CouldNotDownloadCertificate;

use Illuminate\Support\Facades\Mail;
use App\Mail\ResponseFail\Warning;
use App\Mail\ResponseFail\Stop;
use App\Mail\CertificateFail;

use App\Checker\CertificateChecker;

use App\Downtime;
use App\Attempt;
use App\Site;

class ResponseChecker
{
    protected $site;
    protected $certificate;
    protected $statistics;
    protected $response;

    public function __construct(Site $site, TransferStats $statistics)
    {
        $this->site = $site;

        $this->certificate = new CertificateChecker($site);

        $this->statistics = $statistics;

        $this->response = $statistics->getResponse();

    }

    //Process response
    public function check()
    {

        if ($this->isResponseGood()) {

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

        } elseif ($this->isResponseBad()) {

            //Set attempt counter
            $this->site->tried++;

            //Set down_from
            if ($this->site->down_from == null) {
                $this->site->down_from = Carbon::now();
            }

            //If it's needed send a notification
            $this->sendEmailIfNeeded();

        }

        //Record attempt
        if ($this->isResponseBad() || $this->isResponseGood()) {

            Attempt::create([
                'site_id' => $this->site->id,
                'status' => $this->getResponseCode(),
                'load_time' => $this->statistics->getTransferTime(),
                'message' => $this->getResponseMessage(),
                'certificate_validity' => $this->certificate->isValid()
            ]);

        }

        $this->site->save();
    }


    private function hasResponse()
    {
        return $this->response != null;
    }


    private function isResponseGood()
    {
        return $this->hasResponse() && $this->getResponseCode() < 300;
    }

    private function isResponseBad()
    {
        return !$this->hasResponse() || $this->getResponseCode() >= 400;
    }


    private function getResponseCode()
    {
        if ($this->hasResponse()) {
            return $this->response->getStatusCode();
        }

        return null;
    }

    private function getResponseMessage()
    {
        if ($this->hasResponse()) {
            return $this->response->getReasonPhrase();
        }

        return null;
    }


    private function sendEmailIfNeeded()
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
}

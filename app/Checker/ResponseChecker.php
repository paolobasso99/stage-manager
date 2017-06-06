<?php

namespace App\Checker;

use Carbon\Carbon;
use GuzzleHttp\TransferStats;

use Illuminate\Support\Facades\Mail;
use App\Mail\ResponseFail\Warning;
use App\Mail\ResponseFail\Stop;
use App\Mail\CertificateFail;

use App\Checker\CertificateChecker;
use App\Checker\Notificator;

use App\Downtime;
use App\Attempt;
use App\Site;

class ResponseChecker
{
    protected $site;
    protected $certificate;
    protected $statistics;
    protected $response;
    protected $notificate;

    public function __construct(Site $site, TransferStats $statistics, Notificator $notificate)
    {
        $this->site = $site;

        $this->statistics = $statistics;
        $this->response = $statistics->getResponse();

        $this->notificate = $notificate;

        $this->certificate = new CertificateChecker($site, $notificate);

    }

    //Process response
    public function check()
    {
        //Controll if the check response is enabled and kick 3xx
        if( !$this->isToCheck() ) {
            return;
        }

        //Handle the response
        if ($this->isResponseGood()) {

            //Notificate
            $this->notificate->goodResponse();

            //Reset attempt counter
            $this->site->response_attempts = 0;

            //Reset response_down_from and create downtime record
            if (!is_null($this->site->response_down_from)) {

                Downtime::create([
                    'site_id' => $this->site->id,
                    'start_at' => $this->site->response_down_from,
                    'end_at' => Carbon::now()
                ]);

                $this->site->response_down_from = null;
            }

        } elseif ($this->isResponseBad()) {

            //Set attempt counter
            $this->site->response_attempts++;

            //Set response_down_from
            if (is_null($this->site->response_down_from)) {
                $this->site->response_down_from = Carbon::now();
            }

            //Notificate
            $this->notificate->badResponse();

        }

        //Save attempt
        Attempt::create([
            'site_id' => $this->site->id,
            'status' => $this->getResponseCode(),
            'load_time' => $this->statistics->getTransferTime(),
            'message' => $this->getResponseMessage(),
            'certificate_validity' => $this->certificate->isValid()
        ]);


        //Save sites table modifications
        $this->site->save();

    }

    private function isToCheck()
    {
        return $this->site->check_response && (!$this->isResponseRedirect());
    }

    private function hasResponse()
    {
        return !is_null($this->response);
    }


    private function isResponseRedirect()
    {
        return $this->hasResponse() && $this->getResponseCode() >= 300 && $this->getResponseCode() < 400;
    }

    private function isResponseGood()
    {
        return $this->hasResponse() && $this->getResponseCode() < 300;
    }

    private function isResponseBad()
    {
        return (!$this->hasResponse()) || $this->getResponseCode() >= 400;
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

}

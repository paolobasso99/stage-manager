<?php

namespace App\Checker;

use Carbon\Carbon;
use Spatie\SslCertificate\SslCertificate;
use Spatie\SslCertificate\Exceptions\CouldNotDownloadCertificate;

use App\Checker\ResponseChecker;
use App\Checker\Notificator;

use App\Site;

class CertificateChecker
{
    protected $site;
    protected $notificate;

    public function __construct(Site $site, Notificator $notificate)
    {
        $this->site = $site;

        $this->notificate = $notificate;
    }

    public function isValid()
    {

        if( !$this->isToCheck() ) {
            return null;
        }

        try {

            $isValid = SslCertificate::createForHostName($this->site->url)->isValid();

            if ($isValid) {

                $this->notificate->goodCertificate();

                //Good certificate
                $this->site->certificate_down_from = null;
                $this->site->certificate_attempts = 0;

            } else {
                //Bad certificate
                $this->site->certificate_down_from = Carbon::now();
                $this->site->certificate_attempts++;

                $this->notificate->badCertificate();
            }

            return $isValid;

        } catch (CouldNotDownloadCertificate $exception) {

            //Bad certificate
            $this->site->certificate_down_from = Carbon::now();
            $this->site->certificate_attempts++;

            $this->notificate->badCertificate();

            return false;

        }

    }

    private function isToCheck()
    {
        return $this->site->check_certificate;
    }
}

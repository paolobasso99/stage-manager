<?php

namespace App\Checker;

use Carbon\Carbon;
use Spatie\SslCertificate\SslCertificate;
use Spatie\SslCertificate\Exceptions\CouldNotDownloadCertificate;

use Illuminate\Support\Facades\Mail;
use App\Mail\CertificateFail;

use App\Site;

class CertificateChecker
{
    protected $site;

    public function __construct(Site $site)
    {
        $this->site = $site;
    }

    public function isValid()
    {

        if( !$this->isToCheck() ) {
            return null;
        }

        try {

            $isValid = SslCertificate::createForHostName($this->site->url)->isValid();

            //Set certificate_attempts
            $this->recordStatistics($isValid);

            return $isValid;

        } catch (CouldNotDownloadCertificate $exception) {

            $this->recordStatistics(false);

            return false;

        }

    }

    private function isToCheck()
    {
        return $this->site->check_certificate;
    }

    private function recordStatistics($isValid)
    {

        if ($isValid) {
            $this->site->certificate_attempts = 0;
        } else {
            $this->site->certificate_attempts++;
        }

    }
}

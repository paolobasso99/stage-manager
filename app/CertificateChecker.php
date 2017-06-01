<?php

namespace App;

use Carbon\Carbon;
use Spatie\SslCertificate\SslCertificate;
use Spatie\SslCertificate\Exceptions\CouldNotDownloadCertificate;

use Illuminate\Support\Facades\Mail;
use App\Mail\CertificateFail;

class CertificateChecker
{
    protected $site;

    public function __construct(Site $site)
    {
        $this->site = $site;
    }

    //Return the certificate validity if the site should be certificated
    public function check()
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

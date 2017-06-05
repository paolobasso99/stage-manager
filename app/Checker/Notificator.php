<?php

namespace App\Checker;

use Illuminate\Support\Facades\Mail;

use App\Mail\Response\Warning as ResponseWarning;
use App\Mail\Response\Stop as ResponseStop;
use App\Mail\Response\Restore as ResponseRestore;

use App\Mail\Certificate\Warning as CertificateWarning;
use App\Mail\Certificate\Stop as CertificateStop;
use App\Mail\Certificate\Restore as CertificateRestore;

use App\Site;

class Notificator
{
    protected $site;
    protected $addresses;

    public function __construct(Site $site)
    {
        $this->site = $site;

        //Get addresses
        $this->addresses = $this->site->emails->pluck('address')->toArray();
        $this->addresses[] = 'admin@admin.com';
    }

    public function notificate()
    {
        //Response
        if ($this->needResponseWarning()) {
            Mail::to($this->addresses)->send(new ResponseWarning($this->site));
        }

        if ($this->needResponseStop()) {
            Mail::to($this->addresses)->send(new ResponseStop($this->site));
        }

        if ($this->needResponseRestore()) {
            Mail::to($this->addresses)->send(new ResponseRestore($this->site));
        }


        //Certificate
        if ($this->needCertificateWarning()) {
            Mail::to($this->addresses)->send(new CertificateWarning($this->site));
        }

        if ($this->needCertificateStop()) {
            Mail::to($this->addresses)->send(new CertificateStop($this->site));
        }

        if ($this->needCertificateRestore()) {
            Mail::to($this->addresses)->send(new CertificateRestore($this->site));
        }
    }


    private function needResponseWarning()
    {
        return $this->site->tried > 0
            && $this->site->tried % config('check.mail.response_attempts_to_notificate') == 0
            && $this->site->tried < config('check.mail.response_attempts_to_stop');
    }

    private function needResponseStop()
    {
        return $this->site->tried > 0 && $this->site->tried == config('check.mail.response_attempts_to_stop');
    }

    private function needResponseRestore()
    {
        return false;
    }


    private function needCertificateWarning()
    {
        return $this->site->certificate_attempts > 0
            && $this->site->certificate_attempts % config('check.mail.certificate_attempts_to_notificate') == 0
            && $this->site->certificate_attempts < config('check.mail.certificate_attempts_to_stop');
    }

    private function needCertificateStop()
    {
        return $this->site->certificate_attempts > 0 && $this->site->certificate_attempts == config('check.mail.certificate_attempts_to_stop');;
    }

    private function needCertificateRestore()
    {
        return false;
    }
}

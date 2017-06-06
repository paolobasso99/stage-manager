<?php

namespace App\Checker;

use Illuminate\Support\Facades\Mail;

use App\Mail\ResponseWarning;
use App\Mail\ResponseStop;
use App\Mail\ResponseRestore;

use App\Mail\CertificateWarning;
use App\Mail\CertificateStop;
use App\Mail\CertificateRestore;

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

    public function goodResponse()
    {
        if ($this->needResponseRestore()) {
            Mail::to($this->addresses)->send(new ResponseRestore($this->site));
        }
    }

    public function goodCertificate()
    {
        if ($this->needCertificateRestore()) {
            Mail::to($this->addresses)->send(new CertificateRestore($this->site));
        }
    }

    public function badResponse()
    {
        if ($this->needResponseWarning()) {
            Mail::to($this->addresses)->send(new ResponseWarning($this->site));
        }

        if ($this->needResponseStop()) {
            Mail::to($this->addresses)->send(new ResponseStop($this->site));
        }
    }

    public function badCertificate()
    {
        if ($this->needCertificateWarning()) {
            Mail::to($this->addresses)->send(new CertificateWarning($this->site));
        }

        if ($this->needCertificateStop()) {
            Mail::to($this->addresses)->send(new CertificateStop($this->site));
        }
    }

    /**
     * Determinate if a notification is needed
     *
     * @return Boolean
     */
    private function needResponseWarning()
    {
        return config('check.notifications.response.notify_on_fail')
            && $this->site->tried > 0
            && $this->site->tried % config('check.notifications.response.attempts_to_notify') == 0
            && $this->site->tried < config('check.notifications.response.attempts_to_stop_notifications');
    }

    private function needResponseStop()
    {
        return config('check.notifications.response.notify_on_fail')
            && $this->site->tried > 0
            && $this->site->tried == config('check.notifications.response.attempts_to_stop_notifications');
    }

    private function needResponseRestore()
    {
        return config('check.notifications.response.notify_on_restore')
            && $this->site->tried >= config('check.notifications.response.attempts_to_notify');
    }


    private function needCertificateWarning()
    {
        return config('check.notifications.certificate.notify_on_fail')
            && $this->site->certificate_attempts > 0
            && $this->site->certificate_attempts % config('check.notifications.certificate.attempts_to_notify') == 0
            && $this->site->certificate_attempts < config('check.notifications.certificate.attempts_to_stop_notifications');
    }

    private function needCertificateStop()
    {
        return config('check.notifications.certificate.notify_on_fail')
            && $this->site->certificate_attempts > 0
            && $this->site->certificate_attempts == config('check.notifications.certificate.attempts_to_stop_notifications');
    }

    private function needCertificateRestore()
    {
        return config('check.notifications.certificate.notify_on_restore')
            && $this->site->certificate_attempts >= config('check.notifications.certificate.attempts_to_notify');
    }
}

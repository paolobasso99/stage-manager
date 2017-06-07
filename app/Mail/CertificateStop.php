<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

use App\Site;

class CertificateStop extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public $site;

    /**
     * Create a new message instance.
     *
     * @return void
     */
     public function __construct(Site $site)
     {
         $this->site = $site;
     }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.check.certificate.stop')
                    ->subject('Last warning for the SSL of ' . $this->site->url)
                    ->with('site', $this->site);
    }
}

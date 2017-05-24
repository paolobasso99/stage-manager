<?php

namespace App\Mail\SiteDown;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

use App\Site;

class StopChecking extends Mailable
{
    use Queueable, SerializesModels;

    public $side;

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
        return $this->markdown('emails.siteDown.stop')
                    ->subject('LAST WARNING for ' . $this->site->url)
                    ->with('site', $this->site);
    }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

use Illuminate\Support\Facades\Mail;
use App\Mail\SiteDown\Warning;
use App\Mail\SiteDown\StopChecking;

use Spatie\SslCertificate\SslCertificate;
use Spatie\SslCertificate\Exceptions\CouldNotDownloadCertificate;

use App\Downtime;

class Site extends Model
{

    protected $fillable = [
        'url',
        'rate',
        'ssh_username',
        'ssh_password',
        'ssh_root'
    ];

    public function emails()
    {
        return $this->belongsToMany(Email::class, 'email_site');
    }

    public function keyId()
    {
        return $this->belongsTo(Key::class);
    }

    public function attempts(){
        return $this->hasMany(Attempt::class);
    }

    public function downtimes(){
        return $this->hasMany(Downtime::class);
    }



    public function sendEmailIfNeeded()
    {
        //Get addresses
        $addresses = array_merge(
            \App\User::all()->pluck('email')->toArray(),
            $this->emails->pluck('address')->toArray()
        );

        //Remove duplicates
        $addresses = array_unique($addresses);

        //Chek if notification is needed and send
        if($this->tried % config('check.checks_to_warn') == 0
            && $this->tried < config('check.checks_to_stop'))
        {

            Mail::to($addresses)->send(new Warning($this));

        }
        if ($this->tried == config('check.checks_to_stop')) {

            Mail::to($addresses)->send(new StopChecking($this));

        }
    }

    public function startDownTime()
    {
        if ($this->down_from == null) {
            $this->down_from = Carbon::now();
        }
    }

    public function endDownTime()
    {
        if ($this->down_from != null) {

            //Create record of downtime and reset timer
            Downtime::create([
                'site_id' => $this->id,
                'start_at' => $this->down_from,
                'end_at' => Carbon::now()
            ]);

            $this->down_from = null;
        }
    }

    public function checkCertificate()
    {
        if($this->check_certificate){

            try {

                return SslCertificate::createForHostName($this->url)->isValid();

            } catch (CouldNotDownloadCertificate $exception) {

                return false;

            }

        }

        return null;
    }

    public function saveAttempt($response, $transferTime = null)
    {
        if($response != null){

            if ($response->getStatusCode() == 200) {

                //Success response
                $this->endDownTime();
                $this->tried = 0;

            } else {

                //Bad response
                $this->startDownTime();
                $this->tried++;

            }

            //Save attempt
            Attempt::create([
                'site_id' => $this->id,
                'status' => $response->getStatusCode(),
                'load_time' => $transferTime,
                'message' => $response->getReasonPhrase(),
                'certificate_validity' => $this->checkCertificate()
            ]);

        } else {

            //Bad response
            $this->startDownTime();
            $this->tried++;

            //Save attempt
            Attempt::create([
                'site_id' => $this->id,
                'status' => null,
                'load_time' => $transferTime,
                'message' => null,
                'certificate_validity' => $this->checkCertificate()
            ]);
        }
    }

    public function getOnlineTime()
    {
        //Get minutes since creation
        $minutes = Carbon::now()->diffInMinutes($this->created_at);

        //Subtract minutes of downtime
        $minutes = $minutes - $this->getOfflineTime();

        return $minutes;
    }

    public function getOfflineTime()
    {
        $minutes = 0;

        //Add minutes of downtime from database
        foreach($this->downtimes as $downtime){
            $start = Carbon::parse($downtime->start_at);
            $end =Carbon::parse($downtime->end_at);


            $minutes = $minutes + $start->diffInMinutes($end);
        }

        return $minutes;
    }

    public static function toCheck()
    {
        $sites =  \App\Site::all();
        $toCheck = array();

        foreach ($sites as $site) {
            //Check if last control was made too before the rate
            if ($site->checked_at <= Carbon::now()->subMinutes($site->rate) || $site->tried > 0) {
                $toCheck[] = $site;
            }
        }


        return $toCheck;
    }

    public static function failed()
    {
        //Return sites that have failed last checking
        return Site::where('tried', '>', 0)
                    ->orWhere('down_from', '!=', null)
                    ->get();
    }
}

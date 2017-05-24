<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

use App\Mail;
use App\Mail\SiteDown\Warning;
use App\Mail\SiteDown\StopChecking;

use App\Downtime;

class Site extends Model
{
    public function emails()
    {
        return $this->morphedByMany('App\Email', 'notificable');
    }

    public function users()
    {
        return $this->morphedByMany('App\User', 'notificable');
    }

    public function downtimes(){
        return $this->hasMany('App\Downtime');
    }

    public function sendEmailIfNeeded()
    {
        if($this->tried % config('check.checks_to_warn') == 0
            && $this->tried < setting('check.checks_to_stop'))
        {

            Mail::to()->send(new Warning($this));

        }
        else if ($this->tried == setting('check.checks_to_stop')) {

            Mail::to()->send(new StopChecking($this));

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

            Downtime::create([
                'site_id' => $this->id,
                'start_at' => $this->down_from,
                'end_at' => Carbon::now()
            ]);

            $this->down_from = null;
        }
    }

    public function saveAttempt($response)
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

            Attempt::create([
                'site_id' => $this->id,
                'status' => $response->getStatusCode(),
                'message' => $response->getReasonPhrase()
            ]);


        } else {

            //Bad response
            $this->startDownTime();
            $this->tried++;

            Attempt::create([
                'site_id' => $this->id,
                'status' => null,
                'message' => null
            ]);
        }
    }

    public function getOnlineTime()
    {
        $minutes = Carbon::now()->diffInMinutes($this->created_at);
        $minutes = $minutes - $this->getOfflineTime();
        return $minutes;
    }

    public function getOfflineTime()
    {
        $minutes = 0;
        foreach($this->downtimes as $downtime){
            $minutes = $minutes + $downtime->start_at->diffInMinutes($downtime->end_at);
        }

        return $minutes;
    }

    public static function toCheck()
    {
        $sites =  \App\Site::all();
        $toCheck = array();

        foreach ($sites as $site) {

            if ($site->checked_at <= Carbon::now()->subMinutes($site->rate) || $site->tried > 0) {
                $toCheck[] = $site;
            }
        }


        return $toCheck;
    }

    public static function failed()
    {
        return Site::where('tried', '>', 0)
                    ->orWhere('down_from', '!=', null)
                    ->get();
    }
}

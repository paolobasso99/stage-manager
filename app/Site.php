<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

use Illuminate\Support\Facades\Mail;
use App\Mail\SiteDown\Warning;
use App\Mail\SiteDown\StopChecking;

use App\Downtime;

class Site extends Model
{

    public function emails()
    {
        return $this->belongsToMany('App\Email');
    }

    public function downtimes(){
        return $this->hasMany('App\Downtime');
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

            //Save attempt
            Attempt::create([
                'site_id' => $this->id,
                'status' => $response->getStatusCode(),
                'message' => $response->getReasonPhrase()
            ]);


        } else {

            //Bad response
            $this->startDownTime();
            $this->tried++;

            //Save attempt
            Attempt::create([
                'site_id' => $this->id,
                'status' => null,
                'message' => null
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

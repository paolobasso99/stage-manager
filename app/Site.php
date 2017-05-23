<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\Mail\SiteDown\Warning;

use App\Notificable;

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

    public function sendEmailIfNeeded()
    {
        if($this->tried % config('check.checks_to_warn') == 0
            && $this->tried < setting('check.checks_to_stop'))
        {

            \Mail::to()->send(new Warning($this));

        }
        else if ($this->tried == setting('check.checks_to_stop')) {

            \Mail::to()->send(new StopChecking($this));

        }
    }

    public function saveAttempt($response)
    {
        if($response != null){

            if ($response->getStatusCode() === 200) {
                $this->tried = 0;
            } else {
                $this->tried++;
            }

            Attempt::create([
                'site_id' => $this->id,
                'status' => $response->getStatusCode(),
                'message' => $response->getReasonPhrase()
            ]);


        } else {

            $this->tried++;

            Attempt::create([
                'site_id' => $this->id,
                'status' => null,
                'message' => null
            ]);
        }
    }

    public static function toCheck()
    {
        return Site::All();
        return Site::where('checked_at', '>=', \Carbon\Carbon::now()->subMinutes('rate'))
                    ->orWhere('tried', '>', 0)
                    ->get();
    }

    public static function failed()
    {
        return Site::where('tried', '>', 0)
                    ->get();
    }
}

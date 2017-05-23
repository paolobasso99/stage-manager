<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\Mail\SiteDown\Warning;

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
        \Mail::to($this->notificable)->send(new Warning($this));

        if($this->tried % 5 == 0 && $this->tried < 20){

        }

        if ($this->tried == 20) {
            \Mail::to($this->notificable)->send(new StopChecking($this));
        }
    }

    public function saveAttempt($response)
    {
        if($response != null){
            Attempt::create([
                'site_id' => $this->id,
                'status' => $response->getStatusCode(),
                'message' => $response->getReasonPhrase()
            ]);
        } else {
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
}

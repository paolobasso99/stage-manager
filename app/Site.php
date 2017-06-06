<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;

use Illuminate\Support\Facades\Mail;
use App\Mail\ResponseFail\Warning;
use App\Mail\ResponseFail\Stop;
use App\Mail\CertificateFail;

use Spatie\SslCertificate\SslCertificate;
use Spatie\SslCertificate\Exceptions\CouldNotDownloadCertificate;

use App\Downtime;
use App\Attempt;

class Site extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'url',
        'domain',
        'rate',
        'ssh_username',
        'ssh_password',
        'ssh_root'
    ];

    //Relation with emails table
    public function emails()
    {
        return $this->belongsToMany(Email::class, 'email_site');
    }

    //Relation with keys table
    public function keyId()
    {
        return $this->belongsTo(Key::class, 'key_id');
    }

    //Relation with attempts table
    public function attempts(){
        return $this->hasMany(Attempt::class);
    }

    //Relation with downtimes table
    public function downtimes(){
        return $this->hasMany(Downtime::class);
    }


    //Get all the time that a site has been online since its creation
    public function getOnlineTime()
    {
        //Get minutes since creation
        $minutes = Carbon::now()->diffInMinutes($this->created_at);

        //Subtract minutes of downtime
        $minutes = $minutes - $this->getOfflineTime();

        return $minutes;
    }

    //Get all the time that a site has been offline since its creation
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

    //Get if the site is failed
    public function isFailed()
    {
        if($this->tried > 0 || $this->down_from != null || $this->certificate_attempts > 0 || $this->certificate_down_from != null){
            return true;
        }

        return false;
    }


    //Get sites that should be checked
    public static function toCheck()
    {
        $sites =  \App\Site::all();
        $toCheck = array();

        foreach ($sites as $site) {
            //Check if last control was made too before the rate
            if ($site->checked_at <= Carbon::now()->subMinutes($site->rate) || $site->isFailed()) {
                $toCheck[] = $site;
            }
        }

        return $toCheck;
    }

    //Get all failed sites
    public static function failed()
    {
        return Site::where('tried', '>', 0)
                    ->orWhere('down_from', '!=', null)
                    ->orWhere('certificate_attempts', '>', 0)
                    ->orWhere('certificate_down_from', '!=', null)
                    ->get();
    }
}

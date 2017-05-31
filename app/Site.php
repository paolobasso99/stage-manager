<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
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
        return $this->belongsTo(Key::class);
    }

    //Relation with attempts table
    public function attempts(){
        return $this->hasMany(Attempt::class);
    }

    //Relation with downtimes table
    public function downtimes(){
        return $this->hasMany(Downtime::class);
    }

    //Process response
    public function processResponse($statistics)
    {
        $response = $statistics->getResponse();

        //Check if there is a response
        if($response != null){

            //Check if it's a good or a bad response
            if ($response->getStatusCode() < 400) {

                $this->goodResponse();

            } else {

                $this->badResponse();

            }

            //Save attempt
            Attempt::create([
                'site_id' => $this->id,
                'status' => $response->getStatusCode(),
                'load_time' => $statistics->getTransferTime(),
                'message' => $response->getReasonPhrase(),
                'certificate_validity' => $this->getCertificateValidity()
            ]);

        } else {

            $this->badResponse();

            //Save attempt
            Attempt::create([
                'site_id' => $this->id,
                'status' => null,
                'load_time' => $statistics->getTransferTime(),
                'message' => null,
                'certificate_validity' => $this->getCertificateValidity()
            ]);
        }

    }


    //Respond to a bad response
    public function badResponse()
    {
        //Set attempt counter
        $this->tried++;

        //Set down_from
        if ($this->down_from == null) {
            $this->down_from = Carbon::now();
        }

        $this->save();

        //If it's needed send a notification
        $this->sendEmailIfNeeded();
    }

    public function goodResponse()
    {
        //Reset attempt counter
        $this->tried = 0;

        //Reset down_from and create downtime record
        if ($this->down_from != null) {

            Downtime::create([
                'site_id' => $this->id,
                'start_at' => $this->down_from,
                'end_at' => Carbon::now()
            ]);

            $this->down_from = null;
        }

        $this->save();
    }

    public function sendEmailIfNeeded()
    {
        //Get addresses
        $addresses = $this->emails->pluck('address')->toArray();

        //Testing emails
        $addresses[] = 'admin@admin.com';

        //Chek if notification is needed and send
        if($this->tried % config('check.mail.response_attempts_to_notificate') == 0
            && $this->tried < config('check.mail.response_attempts_to_stop'))
        {

            Mail::to($addresses)->send(new Warning($this));

        }
        if ($this->tried == config('check.mail.response_attempts_to_stop')) {

            Mail::to($addresses)->send(new StopChecking($this));

        }

        if ($this->certificate_attempts == config('check.mail.certificate_attempts_to_notificate')) {

            Mail::to($addresses)->send(new CertificateCheckFail($this));

        }
    }

    //Return the certificate validity if the site must be certificated
    public function getCertificateValidity()
    {
        if($this->check_certificate){

            try {

                $certificatValidity = SslCertificate::createForHostName($this->url)->isValid();

                //Set certificate_attempts
                if ($certificatValidity) {
                    $this->certificate_attempts = 0;
                } else {
                    $this->certificate_attempts++;
                }
                $this->save();


                return $certificatValidity;

            } catch (CouldNotDownloadCertificate $exception) {

                $this->certificate_attempts++;
                $this->save();

                return false;

            }

        }

        return null;
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
        if($this->tried > 0 || $this->down_from != null || $this->certificate_attempts > 0){
            return true;
        }

        return false;
    }

    //Get sites that should be checked
    public static function toCheck()
    {
        $sites =  \App\Site::all();

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
                    ->get();
    }
}

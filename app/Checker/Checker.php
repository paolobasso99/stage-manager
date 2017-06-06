<?php

namespace App\Checker;

use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;
use GuzzleHttp\TransferStats;
use Carbon\Carbon;

use App\Site;

use App\Checker\ResponseChecker;
use App\Checker\CertificateChecker;
use App\Checker\Notificator;

class Checker
{
    //Chek one site
    public function checkOne(Site $site, Client $client)
    {
        //Update checked_at
        $site->checked_at = Carbon::now();

        try {

            //Use the Guzzle client to perform a GET request
            $client->getAsync($site->url, [

                //Set client options
                'allow_redirects' => true,
                'connect_timeout' => config('check.guzzle.connect_timeout'),
                'headers' => [
                    'User-Agent' => config('check.guzzle.user_agent')
                ],

                //Perform request
                'on_stats' => function (TransferStats $statistics) use ($site) {

                    $notificate = new Notificator($site);

                    $responseChecker = new ResponseChecker($site, $statistics, $notificate);
                    $responseChecker->check();

                }

            ]);

        } catch (GuzzleException $e) {
            //
        }

        $site->save();
    }

    //Check the sites that needs to be check
    public function check()
    {
        $sites = Site::toCheck();

        $client = new Client();

        foreach ($sites as $site) {
            $this->checkOne($site, $client);
        }

    }

    //Check all the sites
    public function checkAll()
    {
        $sites = Site::all();

        $client = new Client();

        foreach ($sites as $site) {
            $this->checkOne($site, $client);
        }

    }

}

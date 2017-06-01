<?php

namespace App;

use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;
use GuzzleHttp\TransferStats;

use App;
use App\ResponseProcessor;

use Carbon\Carbon;

class SiteChecker
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
                'allow_redirects' => config('check.guzzle.allow_redirects'),
                'connect_timeout' => config('check.guzzle.connect_timeout'),
                'headers' => [
                    'User-Agent' => config('check.guzzle.user_agent')
                ],

                //Perform request
                'on_stats' => function (TransferStats $statistics) use ($site) {

                    (new ResponseProcessor($site))->process($statistics);
                    
                }

            ]);

        } catch (GuzzleException $e) {
            //
        }

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

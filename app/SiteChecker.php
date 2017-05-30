<?php

namespace App;

use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;
use GuzzleHttp\TransferStats;

use Carbon\Carbon;

class SiteChecker
{
    public function resetFailed()
    {
        //Get all failed
        $sites = Site::failed();

        //Reset their stats
        foreach ($sites as $site) {
            $site->tried = 0;
            $site->certificate_attempts = 0;
            $site->down_from = null;
            $site->save();
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

    //Chek one site
    public function checkOne(Site $site, Client $client)
    {

        try {

            //Use the Guzzle client to perform a GET request
            $client->get($site->url, [

                //Set client options
                'allow_redirects' => false,
                'connect_timeout' => config('check.guzzle.connect_timeout'),
                'headers' => [
                    'User-Agent' => config('check.guzzle.user_agent')
                ],

                //Perform request
                'on_stats' => function (TransferStats $stats) use ($site) {

                    $site->saveAttempt(
                        $stats->getResponse(),
                        $stats->getTransferTime()
                    );

                }
            ]);

        }catch (GuzzleException $e) {
            //
        }

    }

}

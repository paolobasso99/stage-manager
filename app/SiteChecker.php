<?php

namespace App;

use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;
use GuzzleHttp\TransferStats;

use Carbon\Carbon;

class SiteChecker
{
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

                //Set custom guzzle options
                foreach (config('check.guzzle.custom') as $key => $value) {
                    $key => $value,
                }

                //Perform request
                'on_stats' => function (TransferStats $stats) use ($site) {

                    $site->saveAttempt(
                        $stats->getResponse(),
                        $stats->getTransferTime()
                    );

                }
            ]);

        } catch (GuzzleException $e) {
            //
        }

    }

}

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
        //Update checked_at
        $site->checked_at = Carbon::now();

        try {

            $response = $client->get($site->url, [
                'connect_timeout' => 10,
                'allow_redirects' => false,
                'headers' => [
                    'User-Agent' => 'Workup Site Checker'
                ],
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

        $site->save();

        $site->sendEmailIfNeeded();

    }

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

}

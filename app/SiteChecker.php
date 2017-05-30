<?php

namespace App;

use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;
use GuzzleHttp\TransferStats;

use Carbon\Carbon;

class SiteChecker
{
    public function check()
    {
        $sites = Site::toCheck();

        $client = new Client();

        foreach ($sites as $site) {
            $this->checkOne($site, $client);
        }

    }

    public function checkAll()
    {
        $sites = Site::all();

        $client = new Client();

        foreach ($sites as $site) {
            $this->checkOne($site, $client);
        }

    }

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

        } catch (CouldNotDownloadCertificate $e) {
            //
        } catch (GuzzleException $e) {
            //
        }

        $site->save();

        $site->sendEmailIfNeeded();

    }

    public function resetAttemptsCounter()
    {
        $sites = Site::failed();

        //Make all sites not failed
        foreach ($sites as $site) {
            $site->tried = 0;
            $site->certificate_attempts = 0;
            $site->down_from = null;
            $site->save();
        }
    }

}

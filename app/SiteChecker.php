<?php

namespace App;

use App\Site;

use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;

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
                'connect_timeout' => 10
            ]);

            $site->saveAttempt($response);

        } catch (\Exception $e) {

            $site->saveAttempt($e->getResponse());

        }

        $site->save();

        $site->sendEmailIfNeeded();

    }

    public function resetAttemptsCounter()
    {
        $sites = Site::failed();

        foreach ($sites as $site) {
            $site->tried = 0;
            $site->down_from = null;
            $site->save();
        }
    }

}

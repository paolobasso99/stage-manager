<?php

namespace App;

use App\Site;
use App\Email;
use App\User;
use App\Attempt;

use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Exception\ConnectException;
use GuzzleHttp\Client;

use Carbon\Carbon;

class SiteChecker
{
    public function checkAll()
    {
        $sites = Site::toCheck();

        $client = new Client();

        foreach ($sites as $site) {
            //Update checked_at
            $site->checked_at = Carbon::now();

            try {

                $response = $client->get($site->url, [
                    'connect_timeout' => 10
                ]);

                //Reset attempt counter
                $site->tried = 0;

                $site->saveAttempt($response);

            } catch (RequestException $e) {

                //Increase attempt counter
                $site->tried++;

                $site->saveAttempt($e->getResponse());

            } catch (ConnectException $e) {

                //Increase attempt counter
                $site->tried++;

                $site->saveAttempt($e->getResponse());

            }

            $site->save();

            $site->sendEmailIfNeeded();
        }

    }

}

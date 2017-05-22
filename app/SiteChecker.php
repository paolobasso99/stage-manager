<?php

namespace App;

use App\Site;
use App\Email;
use App\User;
use App\Attempt;

use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Exception\ConnectException;
use GuzzleHttp\Client;

class SiteChecker
{
    public function run()
    {
        $sites = Site::all();
        $client = new Client();

        foreach ($sites as $site) {

            try {

                $response = $client->get($site->url, [
                    'connect_timeout' => 10
                ]);

                Attempt::create([
                    'site_id' => $site->id,
                    'status' => $response->getStatusCode(),
                    'message' => $response->getReasonPhrase()
                ]);

            } catch (RequestException $e) {

                $response = $e->getResponse();

                Attempt::create([
                    'site_id' => $site->id,
                    'status' => $response->getStatusCode(),
                    'message' => $response->getReasonPhrase()
                ]);

            } catch (ConnectException $e) {
                Attempt::create([
                    'site_id' => $site->id,
                    'status' => null,
                    'message' => null
                ]);

            }

        }

    }
}

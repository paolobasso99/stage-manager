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

use App\Mail\DownEmail;

class SiteChecker
{
    public function run()
    {
        $sites = $this->sitesToCheck();

        var_dump($sites);

        $client = new Client();

        foreach ($sites as $site) {

            //Update checked_at
            $site->checked_at = Carbon::now();

            try {

                $response = $client->get($site->url, [
                    'connect_timeout' => 10
                ]);

                $site->tried = 0;

                //Save attempt
                Attempt::create([
                    'site_id' => $site->id,
                    'status' => $response->getStatusCode(),
                    'message' => $response->getReasonPhrase()
                ]);

            } catch (RequestException $e) {

                $site->tried++;

                //Save attempt
                $response = $e->getResponse();
                Attempt::create([
                    'site_id' => $site->id,
                    'status' => $response->getStatusCode(),
                    'message' => $response->getReasonPhrase()
                ]);

            } catch (ConnectException $e) {

                $site->tried++;

                //Save attempt
                Attempt::create([
                    'site_id' => $site->id,
                    'status' => null,
                    'message' => null
                ]);

            }

            $site->save();

            $this->sendEmailIfNeeded($site);
        }

    }

    private function sitesToCheck() {
        return Site::where('checked_at', '>=', Carbon::now()->subMinutes('rate'))
                ->orWhere('tried', '>', 0)
                ->get();
    }

    private function sendEmailIfNeeded($site) {
        $emails = ['example1@example.com', 'example2@example.com'];

        if($site->tried == $site->rate){
            DownEmail::to($emails)->send($site);
        }
    }
}

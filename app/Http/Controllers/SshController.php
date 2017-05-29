<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use TCG\Voyager\Facades\Voyager;
use SSH;
use Config;
use App\Site;
use App\Key;

class SshController extends Controller
{
    private $output;

    public function __construct()
    {
        $this->middleware('admin.user');
    }

    public function runCommand(Request $request)
    {
        $site = Site::find($request->site_id);

        //Detect if can run the command
        $command = $request->command;
        if (!Voyager::can('ssh_all')) {

            if (!Voyager::can('ssh_artisan')) {
                return 'You have not the permission to run "' . $command . '".';
            }

            if (!preg_match("/\s*(composer)+|(php artisan)+\s+/", $command)) {
                return 'You have not the permission to run "' . $command . '".';
            }

        }

        //Get ip
        $ip = gethostbyname(
            parse_url($site->url, PHP_URL_HOST)
        );

        //Set login credentials
        Config::set('remote.connections.runtime.host', $ip);
        Config::set('remote.connections.runtime.username', $site->ssh_username);

        if (count($site->key) > 0) {
            Config::set('remote.connections.runtime.keytext', $site->key->key);
            Config::set('remote.connections.runtime.keyphrase', $site->key->keyphrase);
        } else {
            Config::set('remote.connections.runtime.password', $site->ssh_password);
        }

        //Perform command
        try {

            SSH::into('runtime')->run([
                'cd ' . strval($site->ssh_root),
                $command
            ],function($line) {
                $this->output = $line.PHP_EOL;
            });

        } catch(\RunTimeException $e) {
            //Catch wrong credentials exception
            return 'Connection via SSH failed, check the credentials.';
        }

        return $this->output;

    }
}

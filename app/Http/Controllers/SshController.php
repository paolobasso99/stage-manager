<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
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

        $command = $request->command;

        $ip = gethostbyname(
            parse_url($site->url, PHP_URL_HOST)
        );

        Config::set('remote.connections.runtime.host', $ip);
        Config::set('remote.connections.runtime.username', $site->ssh_username);

        if (count($site->key) > 0) {
            Config::set('remote.connections.runtime.keytext', $site->key->key);
            Config::set('remote.connections.runtime.keyphrase', $site->key->keyphrase);
        } else {
            Config::set('remote.connections.runtime.password', $site->ssh_password);
        }

        try {

            SSH::into('runtime')->run([
                'cd ' . strval($site->ssh_root),
                $command
            ],function($line) {
                $this->output = $line.PHP_EOL;
            });

        } catch(\RunTimeException $e) {
            $this->output = 'Connection via SSH failed, check the credentials.';
        }

        return $this->output;

    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use SSH;
use Config;
use Crypt;

class SshController extends Controller
{
    private $output;

    public function __construct()
    {
        $this->middleware('admin.user');
    }

    public function runCommand(Request $request)
    {

        try {

            $ip = gethostbyname(
                parse_url($request->host, PHP_URL_HOST)
            );

            $password = Crypt::decrypt($request->password);

            Config::set('remote.connections.runtime.host', $ip);
            Config::set('remote.connections.runtime.username', $request->username);
            Config::set('remote.connections.runtime.password', $password);

            SSH::into('runtime')->run([
                'cd ' . strval($request->root),
                $request->command
            ],function($line) {
                $this->output = $line.PHP_EOL;
            });

        } catch(\RunTimeException $e) {
            $this->output = 'Connection via SSH failed, check the credentials.';
        }

        return $this->output;

    }

    public function console()
    {
        return view('console');
    }
}

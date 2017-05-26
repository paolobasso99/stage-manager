<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use SSH;
use Config;

class SshController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin.user');
    }

    public function run() //$connection, $command
    {

        try {

            $ip = gethostbyname(
                parse_url('http://lab3.workup.it', PHP_URL_HOST)
            );

            Config::set('remote.connections.runtime.host', $ip);
            Config::set('remote.connections.runtime.username', 'root');
            Config::set('remote.connections.runtime.password', '%1t4_l4b3');

            SSH::into('runtime')->run('pwd',function($line) {
                echo $line.PHP_EOL;
            });

        } catch(\RunTimeException $e) {
            echo 'No connection';
        }

    }

    public function console()
    {
        return view('console');
    }

}

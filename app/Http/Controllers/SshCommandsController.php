<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use TCG\Voyager\Facades\Voyager;

use SSH;
use Storage;

use App\Server;
use App\Site;

class SshCommandsController extends SshController
{

    //Run a command from a post request
    public function run(Request $request, Server $server, Site $site = null)
    {
        $commands = array();

        if(!is_null($site->id)){
            $commands['root'] = 'cd ' . strval($site->ssh_root);
        }

        $commands['requested'] = $request->command;

        //Detect if can run the command
        if (!Voyager::can('ssh_all')) {

            if (!Voyager::can('ssh_artisan')) {
                return 'You have not the permission to use the console.';
            }

            if (!preg_match("/\s*(composer{1}|php artisan{1})\s+.*/", $commands['requested'])) {
                return 'You have not the permission to use the console.';
            }

        }

        $this->setSshCredentials($server);

        //Perform command
        try {

            SSH::into('runtime')->run($commands, function($line) {
                $this->output = $line.PHP_EOL;
            });

        } catch(\RunTimeException $e) {
            //Catch wrong credentials exception
            return 'Connection via SSH failed, check the credentials.';
        }

        return $this->output;

    }
}

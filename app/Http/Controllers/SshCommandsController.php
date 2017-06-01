<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use TCG\Voyager\Facades\Voyager;

use SSH;
use Storage;

use App\Site;

class SshCommandsController extends SshController
{

    //Run a command from a post request
    public function run(Request $request)
    {
        $site = Site::find($request->site_id);

        //Detect if can run the command
        $command = $request->command;
        if (!Voyager::can('ssh_all')) {

            if (!Voyager::can('ssh_artisan')) {
                return 'You have not the permission to run "' . $command . '".';
            }

            if (!preg_match("/\s*(composer{1}|php artisan{1})\s+.*/", $command)) {
                return 'You have not the permission to run "' . $command . '".';
            }

        }

        $this->setSshCredentials($site);

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

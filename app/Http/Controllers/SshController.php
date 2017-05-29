<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use TCG\Voyager\Facades\Voyager;
use SSH;
use Storage;
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

    private function setCredentials($site) {
        //Get ip
        $ip = gethostbyname(
            parse_url($site->url, PHP_URL_HOST)
        );

        //Set login credentials
        Config::set('remote.connections.runtime.host', $ip);
        Config::set('remote.connections.runtime.username', $site->ssh_username);

        //Use key or password
        if ($site->key_id != null) {
            //Check if the key exist in the DB
            if(!Key::exist($site->key_id)){
                return 'The key with an "id" of "' . $site->key_id . '" does not exist';
            }

            //Set key credentials
            $key = Key::find($site->key_id);
            Config::set('remote.connections.runtime.keytext', $key->key);
            Config::set('remote.connections.runtime.keyphrase', $key->keyphrase);
        } else {
            //Use password credentials
            Config::set('remote.connections.runtime.password', $site->ssh_password);
        }
    }

    public function dumpDownload()
    {
        $site = Site::find(104);

        //Detect if can download the dump
        if (!Voyager::can('ssh_all')) {
            return 'You have not the permission to download a dump.';
        }

        $this->setCredentials($site);

        $dumpName = 'dump-' . $site->db_database . '-' . \Carbon\Carbon::now()->timestamp . '.sql';

        $command = 'mysqldump';
        $command .= ' -u ' . $site->db_username;
        $command .= ' -p' . $site->db_password;
        $command .= ' ' . $site->db_database;
        $command .= ' > ' . $dumpName;

        //Perform command
        try {
            //Create remote dump
            SSH::into('runtime')->run([
                'cd ' . strval($site->ssh_root),
                $command
            ],function($line) {
                $this->output = $line.PHP_EOL;
            });

            //Create empty dump in local
            Storage::disk('local')->put(
                storage_path('dumps/' . $dumpName),
                ''
            );

            //Download remote dump
            SSH::into('runtime')->get(
                strval($site->ssh_root) . '/' . $dumpName,
                storage_path('dumps/' . $dumpName
            ));

            //Remove remote dump
            SSH::into('runtime')->run([
                'cd ' . strval($site->ssh_root),
                'rm ' . $dumpName
            ]);


        } catch(\RunTimeException $e) {
            //Catch wrong credentials exception
            return 'Connection via SSH failed, check the credentials.';
        }

        return response()->download(storage_path('dumps/' . $dumpName));

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

        $this->setCredentials($site);

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

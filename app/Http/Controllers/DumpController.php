<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use TCG\Voyager\Facades\Voyager;

use SSH;
use Storage;

use App\Site;

class DumpController extends SshController
{

    public function upload(Site $site, Request $request)
    {
        //Detect if can download the dump
        if (!Voyager::can('ssh_all')) {
            return 'You have not the permission to upload a dump.';
        }


        $fileName = 'dump-' . $site->url . '-' . \Carbon\Carbon::now()->timestamp . '.sql';

        $remoteFile = '/home' . '/' . $site->ssh_username . '/' . $fileName;

        $localFile = $request->file('file')->storeAs(
            storage_path('dumps'), $fileName
        );


        $this->setSshCredentials($site);;

        //Define the command
        $command = 'mysqldump';
        $command .= ' -u ' . $site->db_username;
        $command .= ' -p' . $site->db_password;
        $command .= ' ' . $site->db_database;
        $command .= ' < ' . $remoteFile;

        //Perform task
        try {

            //Upload file
            SSH::into('runtime')->put($localFile, $remoteFile);

            //Remove local file
            Storage::disk('local')->delete($localFile);

            //Execute command and delete remote file
            SSH::into('runtime')->run([
                $command,
                'rm ' . $remoteFile
            ]);

        } catch(\RunTimeException $e) {
            //Catch wrong credentials exception
            return 'Connection via SSH failed, check the credentials.';
        }

        return back();
    }

    public function download(Site $site)
    {
        //Detect if can download the dump
        if (!Voyager::can('ssh_all')) {
            return 'You have not the permission to download a dump.';
        }


        $this->setSshCredentials($site);;

        $fileName = 'dump-' . $site->db_database . '-' . \Carbon\Carbon::now()->timestamp . '.sql';

        $localFile = storage_path('dumps/' . $fileName);
        $remoteFile = '/home' . '/' . $site->ssh_username . '/' . $fileName;

        $command = 'mysqldump';
        $command .= ' -u ' . $site->db_username;
        $command .= ' -p' . $site->db_password;
        $command .= ' ' . $site->db_database;
        $command .= ' > ' . $fileName;

        //Perform command
        try {

            //Create remote dump
            SSH::into('runtime')->run($command);

            //Create empty file in local
            Storage::disk('local')->put($localFile, '');

            //Download remote file
            SSH::into('runtime')->get($remoteFile, $localFile);

            //Remove remote file
            SSH::into('runtime')->run('rm ' . $remoteFile);

        } catch(\RunTimeException $e) {
            //Catch wrong credentials exception
            return 'Connection via SSH failed, check the credentials.';
        }

        //Download dump and delete local version
        return response()->download($localFile)->deleteFileAfterSend(true);

    }
}

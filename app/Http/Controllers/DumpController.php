<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use TCG\Voyager\Facades\Voyager;

use SSH;
use Storage;
use Validator;

use App\Site;

class DumpController extends SshController
{

    public function upload(Site $site, Request $request)
    {
        //Validate the request
        $validator = Validator::make($request->only('radius'), [
            'file' => 'required'
        ]);

        if ($validator->fails()) {
            return back()->with([
                    'message'    => "A file is required.",
                    'alert-type' => 'error',
                ]);
        }

        //Check permissions
        if (!Voyager::can('ssh_all')) {
            return back()->with([
                    'message'    => "You have not the permission to upload this file.",
                    'alert-type' => 'error',
                ]);
        }


        $fileName = parse_url($site->url, PHP_URL_HOST) . \Carbon\Carbon::now()->timestamp . '.sql';

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
        //Check permissions
        if (!Voyager::can('ssh_all')) {
            return back()->with([
                    'message'    => "You have not the permission to download this file.",
                    'alert-type' => 'error',
                ]);
        }


        $this->setSshCredentials($site);;

        $fileName = parse_url($site->url, PHP_URL_HOST) . \Carbon\Carbon::now()->timestamp . '.sql';

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
            return back()->with([
                    'message'    => "Connection via SSH failed, check the credentials.",
                    'alert-type' => 'error',
                ]);
        }

        //Download dump and delete local version
        return response()->download($localFile, 'dump.sql')->deleteFileAfterSend(true);

    }
}

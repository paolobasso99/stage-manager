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
        $validator = Validator::make($request->all(), [
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


        $fileName = 'dump-' . md5(parse_url($site->url, PHP_URL_HOST) . '-' . \Carbon\Carbon::now()->timestamp) . '.sql';

        $remoteFile = '/home' . '/' . $site->server->ssh_username . '/' . $fileName;

        $localFile = $request->file('file')->storeAs(
            'uploads/dumps', $fileName
        );


        $this->setSshCredentials($site);

        //Define the command
        $command = 'mysqldump';
        $command .= ' -u ' . $site->db_username;
        $command .= ' -p' . $site->db_password;
        $command .= ' ' . $site->db_database;
        $command .= ' < ' . $remoteFile;

        //Perform task
        try {

            //Upload file
            SSH::into('runtime')->put(storage_path('app/' . $localFile), $remoteFile);

            //Remove local file
            Storage::disk('local')->delete($localFile);

            //Execute command and delete remote file
            SSH::into('runtime')->run([
                'cd',
                $command,
                'rm ' . $remoteFile
            ]);

        } catch(\RunTimeException $e) {
            //Catch wrong credentials exception
            return back()->with([
                    'message'    => "Connection via SSH failed, check the credentials.",
                    'alert-type' => 'error',
                ]);
        }

        return back()->with([
                'message'    => "File successfully uploaded ",
                'alert-type' => 'success',
            ]);
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


        $this->setSshCredentials($site);

        $fileName = md5(parse_url($site->url, PHP_URL_HOST) . '-' . \Carbon\Carbon::now()->timestamp) . '.sql';

        $localFile = 'downloads/dumps/' . $fileName;
        $remoteFile = '/home' . '/' . $site->server->ssh_username . '/' . $fileName;

        $command = 'mysqldump';
        $command .= ' -u ' . $site->db_username;
        $command .= ' -p' . $site->db_password;
        $command .= ' ' . $site->db_database;
        $command .= ' > ' . $fileName;

        //Perform command
        try {

            //Create remote dump
            SSH::into('runtime')->run([
                'cd',
                $command
            ]);

            //Create empty file in local
            Storage::disk('local')->put($localFile, '');

            //Download remote file
            SSH::into('runtime')->get($remoteFile, storage_path('app/' . $localFile));

            //Remove remote file
            SSH::into('runtime')->run([
                'cd',
                'rm ' . $remoteFile
            ]);

        } catch(\RunTimeException $e) {
            //Catch wrong credentials exception
            return back()->with([
                    'message'    => "Connection via SSH failed, check the credentials.",
                    'alert-type' => 'error',
                ]);
        }

        //Download dump and delete local version
        return response()->download(storage_path('app/' . $localFile), 'dump.sql')->deleteFileAfterSend(true);

    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use TCG\Voyager\Facades\Voyager;

use SSH;
use Storage;

use App\Site;

class SitesAvailableController extends SshController
{

    public function upload(Site $site, Request $request)
    {
        //Detect if can download the dump
        if (!Voyager::can('ssh_all')) {
            return 'You have not the permission to upload this file.';
        }


        $fileName = $site->domain . '-' . \Carbon\Carbon::now()->timestamp;

        $remoteFile = '/etc/nginx/sites-available/' . $site->domain;

        $localFile = $request->file('file')->storeAs(
            storage_path('sites-available'), $fileName
        );


        $this->setSshCredentials($site);;


        //Perform task
        try {

            //Upload file
            SSH::into('runtime')->put($localFile, $remoteFile);

            //Remove local file
            Storage::disk('local')->delete($localFile);

            //Delete remote file
            SSH::into('runtime')->run('rm ' . $remoteFile);

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

        $localFile = storage_path('sites-available/' . $site->domain . '-' . \Carbon\Carbon::now()->timestamp);
        $remoteFile = '/etc/nginx/sites-available/' . $site->domain;

        //Perform command
        try {

            //Create empty file in local
            Storage::disk('local')->put($localFile, '');

            //Download remote file
            SSH::into('runtime')->get($remoteFile, $localFile);

        } catch(\RunTimeException $e) {
            //Catch wrong credentials exception
            return 'Connection via SSH failed, check the credentials.';
        }

        //Download file and delete local version
        return response()->download($localFile)->deleteFileAfterSend(true);

    }
}

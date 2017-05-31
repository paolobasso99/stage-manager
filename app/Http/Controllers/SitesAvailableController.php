<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SitesAvailableController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin.user');
    }


    public function download(Site $site)
    {
        //Detect if can download the dump
        if (!Voyager::can('ssh_all')) {
            return 'You have not the permission to download a dump.';
        }

        $site->setSshCredentials();

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

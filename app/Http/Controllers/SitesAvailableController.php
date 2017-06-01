<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use TCG\Voyager\Facades\Voyager;

use SSH;
use Storage;
use Validator;

use App\Site;

class SitesAvailableController extends SshController
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

        $fileName = bcrypt($site->domain . \Carbon\Carbon::now()->timestamp);
        $remoteFile = '/etc/nginx/sites-available/' . $site->domain;

        //Store local file
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

        } catch(\RunTimeException $e) {
            //Catch wrong credentials exception
            return back()->with([
                    'message'    => "Connection via SSH failed, check the credentials.",
                    'alert-type' => 'error',
                ]);
        }

        return back()->with([
                'message'    => "Successfully uploaded " . $site->domain,
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
            return back()->with([
                    'message'    => "Connection via SSH failed, check the credentials.",
                    'alert-type' => 'error',
                ]);
        }

        //Download file and delete local version
        return response()->download($localFile)->deleteFileAfterSend(true);

    }
}

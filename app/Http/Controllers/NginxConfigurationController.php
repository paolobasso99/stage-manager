<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use TCG\Voyager\Facades\Voyager;

use SSH;
use Storage;
use Validator;

use App\Site;

class NginxConfigurationController extends SshController
{

    public function upload(Site $site, Request $request)
    {
        $domain = parse_url($site->url, PHP_URL_HOST);

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

        $fileName = $domain . '-' . md5($site->server->ip . \Carbon\Carbon::now()->timestamp);

        $remoteTempFile = '/home' . '/' . $site->server->ssh_username . '/' . $fileName;
        $remoteFile = '/etc/nginx/sites-available/' . $domain;

        //Store local file
        $localFile = $request->file('file')->storeAs(
            'uploads/nginx-configurations', $fileName
        );

        $this->setSshCredentials($site->server);


        //Perform task
        try {

            //Upload file
            SSH::into('runtime')->put(storage_path('app/' . $localFile), $remoteTempFile);

            //Remove local file
            Storage::disk('local')->delete($localFile);

            //Move file to the right path
            SSH::into('runtime')->run([
                'cd',
                'echo ' . $site->server->ssh_password . ' | sudo -S mv ' . $fileName . ' ' . $remoteFile
            ]);

        } catch(\RunTimeException $e) {
            //Catch wrong credentials exception
            return back()->with([
                    'message'    => "Connection via SSH failed, check the credentials.",
                    'alert-type' => 'error',
                ]);
        }

        return back()->with([
                'message'    => "Successfully uploaded " . $domain,
                'alert-type' => 'success',
            ]);
    }

    public function download(Site $site)
    {
        $domain = parse_url($site->url, PHP_URL_HOST);

        //Check permissions
        if (!Voyager::can('ssh_all')) {
            return back()->with([
                    'message'    => "You have not the permission to download this file.",
                    'alert-type' => 'error',
                ]);
        }

        $this->setSshCredentials($site->server);

        $fileName = $domain . '-' .  md5($site->server->ip . \Carbon\Carbon::now()->timestamp);

        $localFile = 'downloads/nginx-configurations/' . $fileName;
        $remoteFile = '/etc/nginx/sites-available/' . $domain;

        //Perform command
        try {

            //Create empty file in local
            Storage::disk('local')->put($localFile, '');

            //Download remote file
            SSH::into('runtime')->get($remoteFile, storage_path('app/' . $localFile));

        } catch(\RunTimeException $e) {
            //Catch wrong credentials exception
            return back()->with([
                    'message'    => "Connection via SSH failed, check the credentials.",
                    'alert-type' => 'error',
                ]);
        }

        //Download file and delete local version
        return response()->download(storage_path('app/' . $localFile), $domain)->deleteFileAfterSend(true);

    }
}

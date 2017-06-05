<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use TCG\Voyager\Http\Controllers\VoyagerBreadController;
use Illuminate\Support\Facades\DB;
use TCG\Voyager\Facades\Voyager;
use TCG\Voyager\Http\Controllers\Traits\BreadRelationshipParser;

use App\Site;
use Carbon\Carbon;

class SiteController extends VoyagerBreadController
{
    public function update(Request $request, $id)
    {

        $site = Site::find($id);

        $site->url = $request->url;
        $site->domain = $request->domain;
        $site->rate = $request->rate;
        $site->enable_ssh = $request->enable_ssh;
        $site->ssh_username = $request->ssh_username;
        $site->ssh_password = encrypt($request->ssh_password);
        $site->ssh_root = $request->ssh_root;
        $site->key_id = $request->key_id;
        $site->enable_db = $request->enable_db;
        $site->db_host = $request->db_host;
        $site->db_database = $request->db_database;
        $site->db_username = $request->db_username;
        $site->db_password = encrypt($request->db_password);
        $site->check_certificate = $request->check_certificate;
        $site->certificate_attempts = $request->certificate_attempts;
        $site->enable_nginx_configuration = $request->enable_nginx_configuration;
        $site->enable_crontab = $request->enable_crontab;

        $site->save();

        if (isset($request->emails)) {
            $site->emails()->sync($request->emails);
        } else {
            $site->emails()->sync(array());
        }

        return redirect(route('voyager.sites.show', $site));
    }

    public function store(Request $request)
    {
        $request->merge([
            'ssh_password' => encrypt($request->ssh_password),
            'db_password' => encrypt($request->db_password)
        ]);

        return parent::store($request);
    }

    public function destroy(Request $request, $id)
    {
        Site::find($id)->emails()->detach();

        return parent::destroy($request, $id);
    }
}

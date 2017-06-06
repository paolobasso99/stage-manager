<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use TCG\Voyager\Facades\Voyager;
use SSH;
use Config;

use App\Site;
use App\Key;

class SshController extends Controller
{
    protected $output;
    protected $localFile;

    public function __construct()
    {
        $this->middleware('admin.user');
    }

    protected function setSshCredentials(Site $site)
    {

        //Set login credentials
        Config::set('remote.connections.runtime.host', $site->server->ip);
        Config::set('remote.connections.runtime.username', $site->server->ssh_username);

        //Use key or password
        if ($site->server->key_id != null) {
            //Check if the key exist in the DB
            if(!Key::exist($site->server->key_id)){
                return 'The key with an "id" of "' . $site->server->key_id . '" does not exist';
            }

            //Set key credentials
            $key = Key::find($site->server->key_id);
            Config::set('remote.connections.runtime.keytext', $key->key);
            Config::set('remote.connections.runtime.keyphrase', $key->keyphrase);

        } else {
            //Use password credentials
            Config::set('remote.connections.runtime.password', $site->server->ssh_password);
        }
    }

}

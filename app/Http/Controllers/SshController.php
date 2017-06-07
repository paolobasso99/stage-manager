<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use TCG\Voyager\Facades\Voyager;
use SSH;
use Config;

use App\Server;
use App\Key;

class SshController extends Controller
{
    protected $output;
    protected $localFile;

    public function __construct()
    {
        $this->middleware('admin.user');
    }

    protected function setSshCredentials(Server $server)
    {

        //Set login credentials
        Config::set('remote.connections.runtime.host', $server->ip);
        Config::set('remote.connections.runtime.username', $server->ssh_username);

        //Use key or password
        if (!is_null($server->key_id)) {
            //Check if the key exist in the DB
            if(!Key::exist($server->key_id)){
                return 'The key with an "id" of "' . $server->key_id . '" does not exist';
            }

            //Set key credentials
            $key = Key::find($server->key_id);
            Config::set('remote.connections.runtime.keytext', $key->key);

            if (!is_null($key->keyphrase)) {
                Config::set('remote.connections.runtime.keyphrase', decrypt($key->keyphrase));
            }

        } else {
            //Use password credentials
            Config::set('remote.connections.runtime.password', decrypt($server->ssh_password));
        }
    }

}

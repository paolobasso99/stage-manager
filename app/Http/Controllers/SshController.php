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

        //Get ip
        $ip = gethostbyname(
            parse_url($site->url, PHP_URL_HOST)
        );

        //Set login credentials
        Config::set('remote.connections.runtime.host', $ip);
        Config::set('remote.connections.runtime.username', $site->ssh_username);

        //Use key or password
        if ($site->key_id != null) {
            //Check if the key exist in the DB
            if(!Key::exist($site->key_id)){
                return 'The key with an "id" of "' . $site->key_id . '" does not exist';
            }

            //Set key credentials
            $key = Key::find($site->key_id);
            Config::set('remote.connections.runtime.keytext', $key->key);
            Config::set('remote.connections.runtime.keyphrase', $key->keyphrase);

        } else {
            //Use password credentials
            Config::set('remote.connections.runtime.password', decrypt($site->ssh_password));
        }
    }

}

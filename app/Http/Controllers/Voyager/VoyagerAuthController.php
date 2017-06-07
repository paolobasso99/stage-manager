<?php

namespace App\Http\Controllers\Voyager;

use TCG\Voyager\Http\Controllers\VoyagerAuthController as BaseVoyagerAuthController;
use Illuminate\Http\Request;

class VoyagerAuthController extends BaseVoyagerAuthController
{
    public function postLogin(Request $request)
    {
        //Validate
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required'
        ]);

        //Edit email for ldap
        if(preg_match("/.*@workup.it\s*/", $request->email)){
            $request->merge([
                'email' => preg_replace("/@workup.it\s*/", '@bassano.workup.it', $request->email)
            ]);
        }

        return parent::postLogin($request);
    }
}

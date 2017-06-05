<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use TCG\Voyager\Http\Controllers\VoyagerBreadController;
use Illuminate\Support\Facades\DB;
use TCG\Voyager\Facades\Voyager;
use TCG\Voyager\Http\Controllers\Traits\BreadRelationshipParser;

use App\Email;

class EmailController extends VoyagerBreadController
{
    //Destroy an email
    public function destroy(Request $request, $id)
    {
        //Detach related sites
        Email::find($id)->sites()->detach();

        return parent::destroy($request, $id);
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $counter = array();
        $counter['sites'] = \App\Site::count();
        $counter['users'] = \App\User::count();
        $counter['emails'] = \App\Email::count();

        return view('dashboard')->with('counter', $counter);
    }
}

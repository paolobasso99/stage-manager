<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Site;

class SiteController extends Controller
{
    public function show(Site $site)
    {
        return view('sites.show')->with('site', $site);

    }
}

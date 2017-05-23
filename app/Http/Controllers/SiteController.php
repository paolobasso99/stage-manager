<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Site;

class SiteController extends Controller
{
    public function index()
    {
        return view('sites.index');

    }

    public function show(Site $site)
    {
        return view('sites.show')->with('site', $site);

    }

    public function create()
    {
        return view('sites.create');

    }

    public function store()
    {
        $this->validate(request(), [
            'url' => 'required|url|unique:sites',
            'rate' => 'required|integer'
        ]);

        $site = new Site();

        $site->url = request('url');
        $site->rate = request('rate');

        $site->save();

        return redirect(route('voyager.sites.index'));

    }
}

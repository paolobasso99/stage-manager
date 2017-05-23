<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Site;

class SiteController extends Controller
{
    public function index()
    {
        $sites = Site::all();

        return view('sites.index')->with('sites', $sites);

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

    public function edit(Site $site)
    {
        return view('sites.edit')->with('site', $site);

    }

    public function update(Site $site)
    {
        $this->validate(request(), [
            'url' => 'required|url|unique:sites',
            'rate' => 'required|integer'
        ]);

        $site->url = request('url');
        $site->rate = request('rate');

        $site->save();

        return redirect(route('voyager.sites.index'));

    }

    public function destroy(Site $site)
    {
        $site->delete();

        return redirect(route('voyager.sites.index'));

    }
}

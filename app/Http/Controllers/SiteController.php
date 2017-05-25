<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Site;
use TCG\Voyager\Http\Controllers\VoyagerBreadController;
use Illuminate\Support\Facades\DB;
use TCG\Voyager\Facades\Voyager;
use TCG\Voyager\Http\Controllers\Traits\BreadRelationshipParser;

class SiteController extends VoyagerBreadController
{

    public function show(Request $request, $id)
    {
        //BEGIN part copied from voyager/src/Http/Controllers/VoyagerBreadController
        $slug = $this->getSlug($request);

        $dataType = Voyager::model('DataType')->where('slug', '=', $slug)->first();

        Voyager::canOrFail('read_'.$dataType->name);

        $relationships = $this->getRelationships($dataType);
        if (strlen($dataType->model_name) != 0) {
            $model = app($dataType->model_name);
            $dataTypeContent = call_user_func([$model->with($relationships), 'findOrFail'], $id);
        } else {
            $dataTypeContent = DB::table($dataType->name)->where('id', $id)->first();
        }

        $dataTypeContent = $this->resolveRelations($dataTypeContent, $dataType, true);

        $isModelTranslatable = is_bread_translatable($dataTypeContent);

        $view = 'voyager::bread.read';

        if (view()->exists("voyager::$slug.read")) {
            $view = "voyager::$slug.read";
        }
        //END part copied


        $site = Site::find($id);

        $emails = $site->emails;

        return view($view, compact(
            'dataType',
            'dataTypeContent',
            'isModelTranslatable',
            'site',
            'emails'
        ));
    }

    public function create(Request $request)
    {
        //BEGIN part copied from voyager/src/Http/Controllers/VoyagerBreadController
        $slug = $this->getSlug($request);

        $dataType = Voyager::model('DataType')->where('slug', '=', $slug)->first();

        Voyager::canOrFail('add_'.$dataType->name);

        $dataTypeContent = (strlen($dataType->model_name) != 0)
                            ? new $dataType->model_name()
                            : false;

        $isModelTranslatable = is_bread_translatable($dataTypeContent);

        $view = 'voyager::bread.edit-add';

        if (view()->exists("voyager::$slug.edit-add")) {
            $view = "voyager::$slug.edit-add";
        }
        //END part copied

        $emails = \App\Email::all();

        return view($view, compact(
            'dataType',
            'dataTypeContent',
            'isModelTranslatable',
            'emails'
        ));
    }

    public function edit(Request $request, $id)
    {
        //BEGIN part copied from voyager/src/Http/Controllers/VoyagerBreadController
        $slug = $this->getSlug($request);

        $dataType = Voyager::model('DataType')->where('slug', '=', $slug)->first();

        Voyager::canOrFail('edit_'.$dataType->name);

        $relationships = $this->getRelationships($dataType);

        $dataTypeContent = (strlen($dataType->model_name) != 0)
            ? app($dataType->model_name)->with($relationships)->findOrFail($id)
            : DB::table($dataType->name)->where('id', $id)->first();

        $isModelTranslatable = is_bread_translatable($dataTypeContent);

        $view = 'voyager::bread.edit-add';

        if (view()->exists("voyager::$slug.edit-add")) {
            $view = "voyager::$slug.edit-add";
        }
        //End part copied

        $emails = \App\Email::all();

        $site = Site::find($id);

        return view($view, compact(
            'dataType',
            'dataTypeContent',
            'isModelTranslatable',
            'site',
            'emails'
        ));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'url' => 'required|url',
            'rate' => 'required|integer',
            'emails.*' => 'integer'
        ]);

        $site = new Site();

        $site->url = $request->url;
        $site->rate = $request->rate;

        $site->save();

        if (isset($request->emails)) {
            $site->emails()->sync($request->emails);
        } else {
            $site->emails()->sync(array());
        }

        return redirect(route('voyager.sites.edit', $site));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'url' => 'required|url',
            'rate' => 'required|integer',
            'emails.*' => 'integer'
        ]);

        $site = Site::find($id);

        $site->url = $request->url;
        $site->rate = $request->rate;

        $site->save();

        if (isset($request->emails)) {
            $site->emails()->sync($request->emails);
        } else {
            $site->emails()->sync(array());
        }

        return redirect(route('voyager.sites.show', $site));
    }

    // public function index()
    // {
    //     $sites = Site::all();
    //
    //     return view('sites.index')->with('sites', $sites);
    //
    // }

    // public function show(Site $site)
    // {
    //     return view('sites.show')->with('site', $site);
    //
    // }

    // public function create()
    // {
    //     return view('sites.create');
    //
    // }
    //
    // public function store()
    // {
    //     $this->validate(request(), [
    //         'url' => 'required|url|unique:sites',
    //         'rate' => 'required|integer'
    //     ]);
    //
    //     $site = new Site();
    //
    //     $site->url = request('url');
    //     $site->rate = request('rate');
    //
    //     $site->save();
    //
    //     return redirect(route('voyager.sites.index'));
    //
    // }
    //
    // public function edit(Site $site)
    // {
    //     return view('sites.edit')->with('site', $site);
    //
    // }
    //
    // public function update(Site $site)
    // {
    //     $this->validate(request(), [
    //         'url' => 'required|url|unique:sites',
    //         'rate' => 'required|integer'
    //     ]);
    //
    //     $site->url = request('url');
    //     $site->rate = request('rate');
    //
    //     $site->save();
    //
    //     return redirect(route('voyager.sites.index'));
    //
    // }
    //
    // public function destroy(Site $site)
    // {
    //     $site->delete();
    //
    //     return redirect(route('voyager.sites.index'));
    //
    // }
}

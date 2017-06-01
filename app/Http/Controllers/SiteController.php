<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use TCG\Voyager\Http\Controllers\VoyagerBreadController;
use Illuminate\Support\Facades\DB;
use TCG\Voyager\Facades\Voyager;
use TCG\Voyager\Http\Controllers\Traits\BreadRelationshipParser;

use App\Site;
use Carbon\Carbon;

class SiteController extends VoyagerBreadController
{
    //Get an array rapresenting the average load time per day
    private function getLoadTimePerDay(Site $site, $numberOfDays) {
        $stats = array();

        // $stats = ['Day' => load time]
        for ($i = $numberOfDays - 1; $i >= 0; $i--) {

            //Select all attempts that happened in the day
            $load_time = $site->attempts()->where([
                ['created_at', '<=', Carbon::now()->subDays($i)->endOfDay()],
                ['created_at', '>=', Carbon::now()->subDays($i)->startOfDay()]
            ])->pluck('load_time')->toArray();

            //Get average
            if (count($load_time) > 0) {
                $load_time = array_sum($load_time) / count($load_time);
            } else {
                $load_time = 0;
            }

            //Save load time
            $stats[Carbon::now()->subDays($i)->format('l')] = $load_time;

        }

        return $stats;
    }

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

        $loadTimePerDay = $this->getLoadTimePerDay($site, 7);

        //Show the SSH console?
        $hasSsh = $site->enable_ssh && (Voyager::can('ssh_artisan') || Voyager::can('ssh_all'));

        //Show dump manager?
        $hasDatabase = $site->enable_db && Voyager::can('ssh_all');

        //Show sites-available manager?
        $hasSitesAvailable = $site->enable_nginx_configuration && Voyager::can('ssh_all');

        $hasCrontab = $site->enable_crontab && Voyager::can('ssh_all');

        //Return the view
        return view($view, compact(
            'dataType',
            'dataTypeContent',
            'isModelTranslatable',
            'site',
            'emails',
            'hasSsh',
            'hasDatabase',
            'hasSitesAvailable',
            'hasCrontab',
            'loadTimePerDay'
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

        $keys = \App\Key::all();

        return view($view, compact(
            'dataType',
            'dataTypeContent',
            'isModelTranslatable',
            'emails',
            'keys'
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

        $keys = \App\Key::all();

        return view($view, compact(
            'dataType',
            'dataTypeContent',
            'isModelTranslatable',
            'site',
            'emails',
            'keys'
        ));
    }

    public function store(Request $request)
    {
        $slug = $this->getSlug($request);

        $dataType = Voyager::model('DataType')->where('slug', '=', $slug)->first();

        // Check permission
        Voyager::canOrFail('add_'.$dataType->name);

        //Validate fields with ajax
        $val = $this->validateBread($request->all(), $dataType->addRows);

        if ($val->fails()) {
            return response()->json(['errors' => $val->messages()]);
        }

        $this->validate($request, [
            'url' => 'required|url',
            'rate' => 'required|integer',
            'ssh_username' => 'string|nullable',
            'ssh_password' => 'string|nullable',
            'ssh_root' => 'string|nullable',
            'emails.*' => 'integer',
            'key' => 'integer'
        ]);

        if (!$request->ajax()) {
            $data = $this->insertUpdateData($request, $slug, $dataType->addRows, new $dataType->model_name());

            if (isset($request->emails)) {
                $data->emails()->sync($request->emails);
            } else {
                $data->emails()->sync(array());
            }

            return redirect()
                ->route("voyager.{$dataType->slug}.edit", ['id' => $data->id])
                ->with([
                        'message'    => "Successfully Added New {$dataType->display_name_singular}",
                        'alert-type' => 'success',
                    ]);
        }
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'url' => 'required|url',
            'rate' => 'required|integer',
            'ssh_username' => 'string|nullable',
            'ssh_password' => 'string|nullable',
            'ssh_root' => 'string|nullable',
            'emails.*' => 'integer',
            'key' => 'integer'
        ]);

        $site = Site::find($id);

        $site->url = $request->url;
        $site->rate = $request->rate;
        $site->ssh_username = $request->ssh_username;
        $site->ssh_password = $request->ssh_password;
        $site->ssh_root = $request->ssh_root;
        $site->key_id = $request->key_id;

        $site->save();

        if (isset($request->emails)) {
            $site->emails()->sync($request->emails);
        } else {
            $site->emails()->sync(array());
        }

        return redirect(route('voyager.sites.show', $site));
    }

    public function destroy(Request $request, $id)
    {
        Site::find($id)->emails()->detach();


        //BEGIN part copied from voyager/src/Http/Controllers/VoyagerBreadController
        $slug = $this->getSlug($request);

        $dataType = Voyager::model('DataType')->where('slug', '=', $slug)->first();

        Voyager::canOrFail('delete_'.$dataType->name);

        $data = call_user_func([$dataType->model_name, 'findOrFail'], $id);

        if (is_bread_translatable($data)) {
            $data->deleteAttributeTranslations($data->getTranslatableAttributes());
        }

        foreach ($dataType->deleteRows as $row) {
            if ($row->type == 'image') {
                $this->deleteFileIfExists('/uploads/'.$data->{$row->field});

                $options = json_decode($row->details);

                if (isset($options->thumbnails)) {
                    foreach ($options->thumbnails as $thumbnail) {
                        $ext = explode('.', $data->{$row->field});
                        $extension = '.'.$ext[count($ext) - 1];

                        $path = str_replace($extension, '', $data->{$row->field});

                        $thumb_name = $thumbnail->name;

                        $this->deleteFileIfExists('/uploads/'.$path.'-'.$thumb_name.$extension);
                    }
                }
            }
        }

        $data = $data->destroy($id)
            ? [
                'message'    => "Successfully Deleted {$dataType->display_name_singular}",
                'alert-type' => 'success',
            ]
            : [
                'message'    => "Sorry it appears there was a problem deleting this {$dataType->display_name_singular}",
                'alert-type' => 'error',
            ];

        return redirect()->route("voyager.{$dataType->slug}.index")->with($data);
        //END part copied
    }
}

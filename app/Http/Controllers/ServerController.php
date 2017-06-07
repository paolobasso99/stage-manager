<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use TCG\Voyager\Http\Controllers\VoyagerBreadController;
use Illuminate\Support\Facades\DB;
use TCG\Voyager\Facades\Voyager;
use TCG\Voyager\Http\Controllers\Traits\BreadRelationshipParser;

use App\Site;
use Carbon\Carbon;

class ServerController extends VoyagerBreadController
{
    //***************************************
    //
    //                   /\
    //                  /  \
    //                 / /\ \
    //                / ____ \
    //               /_/    \_\
    //
    //
    // Add a new item of our Data Type BRE(A)D
    //
    //****************************************

    public function create(Request $request)
    {
        $slug = $this->getSlug($request);

        $dataType = Voyager::model('DataType')->where('slug', '=', $slug)->first();

        // Check permission
        Voyager::canOrFail('add_'.$dataType->name);

        $dataTypeContent = (strlen($dataType->model_name) != 0)
                            ? new $dataType->model_name()
                            : false;

        // Check if BREAD is Translatable
        $isModelTranslatable = is_bread_translatable($dataTypeContent);


        return view('servers.create', compact('dataType', 'dataTypeContent', 'isModelTranslatable'));
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

        if (!$request->ajax()) {
            $data = $this->insertUpdateData($request, $slug, $dataType->addRows, new $dataType->model_name());


            //BEGIN custom part
            if (isset($request->key_id)) {
                $data->key()->associate(\App\Key::find($request->key_id));
            } else {
                $data->key()->dissociate();
            }

            $data->save();
            //END custom part


            return redirect()
                ->route("voyager.{$dataType->slug}.edit", ['id' => $data->id])
                ->with([
                        'message'    => "Successfully Added New {$dataType->display_name_singular}",
                        'alert-type' => 'success',
                    ]);
        }
    }

    //***************************************
    //                ______
    //               |  ____|
    //               | |__
    //               |  __|
    //               | |____
    //               |______|
    //
    //  Edit an item of our Data Type BR(E)AD
    //
    //****************************************

    public function edit(Request $request, $id)
    {
        $slug = $this->getSlug($request);

        $dataType = Voyager::model('DataType')->where('slug', '=', $slug)->first();

        Voyager::canOrFail('edit_'.$dataType->name);

        $relationships = $this->getRelationships($dataType);

        $dataTypeContent = (strlen($dataType->model_name) != 0)
            ? app($dataType->model_name)->with($relationships)->findOrFail($id)
            : DB::table($dataType->name)->where('id', $id)->first();

        $isModelTranslatable = is_bread_translatable($dataTypeContent);


        return view('servers.edit', compact('dataType', 'dataTypeContent', 'isModelTranslatable'));
    }

    public function update(Request $request, $id)
    {

        $slug = $this->getSlug($request);
        $dataType = Voyager::model('DataType')->where('slug', '=', $slug)->first();
        Voyager::canOrFail('edit_'.$dataType->name);
        $val = $this->validateBread($request->all(), $dataType->addRows);
        if ($val->fails()) {
            return response()->json(['errors' => $val->messages()]);
        }
        if (!$request->ajax()) {
            $data = call_user_func([$dataType->model_name, 'findOrFail'], $id);

            $this->insertUpdateData($request, $slug, $dataType->editRows, $data);

            //BEGIN custom part
            if (isset($request->key_id)) {
                $data->key()->associate(\App\Key::find($request->key_id));
            } else {
                $data->key()->dissociate();
            }

            $data->save();
            //END custom part


            return redirect()
            ->route("voyager.{$dataType->slug}.edit", ['id' => $id])
            ->with([
                'message'    => "Successfully Updated {$dataType->display_name_singular}",
                'alert-type' => 'success',
                ]);
        }
    }
}

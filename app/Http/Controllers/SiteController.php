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
    public function store(Request $request)
    {
        $request->merge([
            'ssh_password' => encrypt($request->ssh_password),
            'db_password' => encrypt($request->db_password)
        ]);

        return parent::store($request);
    }

    public function destroy(Request $request, $id)
    {
        Site::find($id)->emails()->detach();

        return parent::destroy($request, $id);
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

        $view = 'voyager::bread.edit-add';

        if (view()->exists("voyager::$slug.edit-add")) {
            $view = "voyager::$slug.edit-add";
        }


        //BEGIN custom part
        $dataTypeContent->ssh_password = decrypt($dataTypeContent->ssh_password);
        $dataTypeContent->db_password = decrypt($dataTypeContent->db_password);
        //END custom part


        return view($view, compact('dataType', 'dataTypeContent', 'isModelTranslatable'));
    }

    public function update(Request $request, $id)
    {

        //BEGIN custom part
        $request->merge([
            'ssh_password' => encrypt($request->ssh_password),
            'db_password' => encrypt($request->db_password)
        ]);
        //END custom part


        $slug = $this->getSlug($request);
        $dataType = Voyager::model('DataType')->where('slug', '=', $slug)->first();

        // Check permission
        Voyager::canOrFail('edit_'.$dataType->name);

        //Validate fields with ajax
        $val = $this->validateBread($request->all(), $dataType->addRows);

        if ($val->fails()) {
            return response()->json(['errors' => $val->messages()]);
        }

        if (!$request->ajax()) {
            $data = call_user_func([$dataType->model_name, 'findOrFail'], $id);
            $this->insertUpdateData($request, $slug, $dataType->editRows, $data);


            //BEGIN custom part
            if (isset($request->emails)) {
                $data->emails()->sync($request->emails);
            } else {
                $data->emails()->sync(array());
            }

            if (isset($request->key_id)) {
                $data->keyId()->associate($request->key_id);
            } else {
                $data->keyId()->dissociate();
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

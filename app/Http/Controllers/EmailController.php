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
    public function destroy(Request $request, $id)
    {
        Email::find($id)->sites()->detach();


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

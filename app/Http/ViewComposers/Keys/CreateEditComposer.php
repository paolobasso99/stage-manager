<?php

namespace App\Http\ViewComposers\Keys;

use Illuminate\View\View;

use TCG\Voyager\Facades\Voyager;
use TCG\Voyager\Http\Controllers\Traits\BreadRelationshipParser;

use App\Site;
use Carbon\Carbon;

class CreateEditComposer
{
    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $key = $view->getData()['dataTypeContent'];

        $view->with('key', $key);
    }
}

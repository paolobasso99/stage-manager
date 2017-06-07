<?php

namespace App\Http\ViewComposers\Servers;

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
        $server = $view->getData()['dataTypeContent'];

        $keys = \App\Key::all();

        $view->with('server', $server);
        $view->with('keys', $keys);
    }
}

<?php

namespace App\Http\ViewComposers\Sites;

use Illuminate\View\View;

use TCG\Voyager\Facades\Voyager;
use TCG\Voyager\Http\Controllers\Traits\BreadRelationshipParser;

use App\Site;
use Carbon\Carbon;

class EditAddComposer
{
    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $site = $view->getData()['dataTypeContent'];

        $contacts = \App\Contact::all();
        $keys = \App\Key::all();
        $servers = \App\Server::all();

        $view->with('site', $site);
        $view->with('contacts', $contacts);
        $view->with('keys', $keys);
        $view->with('servers', $servers);
    }
}

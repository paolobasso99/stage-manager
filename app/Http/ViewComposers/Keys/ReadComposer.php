<?php

namespace App\Http\ViewComposers\Keys;

use Illuminate\View\View;

use TCG\Voyager\Facades\Voyager;
use TCG\Voyager\Http\Controllers\Traits\BreadRelationshipParser;

use App\Site;
use Carbon\Carbon;

class ReadComposer
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

        //Determinate if has a feature
        $has = [
            'console' => false,
            'crontab' => false
        ];

        //Show the SSH console?
        $has['console'] = $server->enable_console && (Voyager::can('ssh_artisan') || Voyager::can('ssh_all'));

        //Show crontab manager?
        $has['crontab'] = $server->enable_crontab && Voyager::can('ssh_all');

        //Include dependencies to the view
        $view->with('server', $server);
        $view->with('has', $has);
    }
}

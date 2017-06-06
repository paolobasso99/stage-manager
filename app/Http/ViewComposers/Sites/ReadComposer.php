<?php

namespace App\Http\ViewComposers\Sites;

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
        $site = $view->getData()['dataTypeContent'];

        //Determinate if has a feature
        $has = [
            'console' => false,
            'crontab' => false,
            'database' => false,
            'nginx_configuration' => false
        ];

        if(!is_null($site->server)){
            //Show the SSH console?
            $has['console'] = $site->server->enable_console && (Voyager::can('ssh_artisan') || Voyager::can('ssh_all'));

            //Show crontab manager?
            $has['crontab'] = $site->server->enable_crontab && Voyager::can('ssh_all');

            //Show dump manager?
            $has['database'] = $site->enable_db && Voyager::can('ssh_all');

            //Show sites-available manager?
            $has['nginx_configuration'] = $site->enable_nginx_configuration && Voyager::can('ssh_all');
        }

        //Include dependencies to the view
        $view->with('site', $site);
        $view->with('contacts', $site->contacts);
        $view->with('loadTimePerDay',  $this->getLoadTimePerDay($site, 7));
        $view->with('has', $has);
    }


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
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $counter = array();
        $counter['sites'] = \App\Site::count();
        $counter['users'] = \App\User::count();
        $counter['emails'] = \App\Email::count();
        $counter['downTimes'] = \App\Downtime::count();

        $downPerMonth = $this->getDownTimesPerMonth(5);

        return view('dashboard')
                   ->with('counter', $counter)
                   ->with('lastDown', \App\Downtime::first())
                   ->with('downPerMonth', $downPerMonth);
    }

    private function getDownTimesPerMonth($numberOfMonths) {

        $stats = array();

        // $stats = ['Month' => times of down]
        for ($i = $numberOfMonths - 1; $i >= 0; $i--) {

            //count from downtimes where end_at is in the month
            $stats[Carbon::now()->subMonths($i)->format('F')] =
            \App\Downtime::where([
                ['end_at', '<=', Carbon::now()->subMonths($i)->lastOfMonth()],
                ['end_at', '>=', Carbon::now()->subMonths($i)->firstOfMonth()]
            ])->count();

        }

        return $stats;
    }
}

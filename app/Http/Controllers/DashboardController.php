<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin.user');
    }

    //Display the dashboard
    public function index()
    {
        $counter = array();
        $counter['sites'] = \App\Site::count();
        $counter['users'] = \App\User::count();
        $counter['contacts'] = \App\Contact::count();
        $counter['downTimes'] = \App\Downtime::count();

        $downPerMonth = $this->getDownTimesPerMonth(5);

        return view('dashboard')
                   ->with('counter', $counter)
                   ->with('lastDown', \App\Downtime::first())
                   ->with('downPerMonth', $downPerMonth)
                   ->with('loadTimePerDay', $this->getLoadTimePerDay(3));
    }

    //Get an array rapresenting the number of downtimes per month
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

    //Get an array rapresenting the average load time per day
    private function getLoadTimePerDay($numberOfDays) {
        $stats = array();

        // $stats = ['Day' => load time]
        for ($i = $numberOfDays - 1; $i >= 0; $i--) {

            //Select all attempts that happened in the day
            $load_time = \App\Attempt::where([
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

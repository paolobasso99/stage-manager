<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Voyager::routes();

Route::get('/', 'DashboardController@index')->name('voyager.dashboard');

//Dummy route
use Adldap\Laravel\Facades\Adldap;

Route::get('dummy', function(){
    $users = Adldap::search()->users()->get();

    foreach ($users as $user) {
        echo "<p>" . $user->mail[0] . "</p>";
    }

    //dd(Adldap::search()->users()->find('Newsletter')->mail);
});

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


//Dummy routes

Route::get('dummy', function(){
    return back();
});

Route::get('ssh', 'SshController@run');
Route::get('console', 'SshController@console');

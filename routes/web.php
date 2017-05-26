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
Route::post('ssh', 'SshController@runCommand')->name('ssh');


//Dummy routes

Route::get('dummy', function(){

});

Route::get('console', 'SshController@console');

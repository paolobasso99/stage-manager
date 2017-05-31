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


Route::post('ssh', 'SshCommandsController@run')->name('ssh');

Route::get('dumps/{site}', 'DumpController@download')->name('dumps.download');
Route::post('dumps/{site}', 'DumpController@upload')->name('dumps.upload');

Route::get('sites-available/{site}', 'SitesAvailableController@download')->name('sites-available.download');
Route::post('sites-available/{site}', 'SitesAvailableController@upload')->name('sites-available.upload');

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
Route::get('dumps/download/{site}', 'SshController@dumpDownload')->name('ssh.dumps.download');


//Dummy routes

Route::get('dummy', 'SshController@dumpDownload');

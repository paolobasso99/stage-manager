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


Route::post('ssh/{server}/{site?}', 'SshCommandsController@run')->name('ssh');

Route::get('crontab/{server}', 'CrontabController@download')->name('crontab.download');
Route::post('crontab/{server}', 'CrontabController@upload')->name('crontab.upload');

Route::get('dump/{site}', 'DumpController@download')->name('dumps.download');
Route::post('dump/{site}', 'DumpController@upload')->name('dumps.upload');

Route::get('nginx-configuration/{site}', 'NginxConfigurationController@download')->name('nginx-configuration.download');
Route::post('nginx-configuration/{site}', 'NginxConfigurationController@upload')->name('nginx-configuration.upload');

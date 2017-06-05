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

Route::get('dump/{site}', 'DumpController@download')->name('dumps.download');
Route::post('dump/{site}', 'DumpController@upload')->name('dumps.upload');

Route::get('nginx-configuration/{site}', 'NginxConfigurationController@download')->name('sites-available.download');
Route::post('nginx-configuration/{site}', 'NginxConfigurationController@upload')->name('sites-available.upload');

Route::get('crontab/{site}', 'CrontabController@download')->name('crontab.download');
Route::post('crontab/{site}', 'CrontabController@upload')->name('crontab.upload');

//Dummy
use Adldap\Laravel\Facades\Adldap;
Route::get('dummy/ldap', function(){
    $ldapUsers = Adldap::search()->users()->find('Matteo Faldani');

    dd($ldapUsers);
});

Route::get('dummy/ssh/{site}', 'SshController@setSshCredentials');

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

Route::group(['middleware' => ['authed']], function () {
    Route::get('/game', 'GameController@index')->name('game');

    Route::post('/game/ajax/module/load', 'ModuleController@loadModule');
    Route::post('/game/ajax/module/unload', 'ModuleController@unloadModule');
    Route::post('/game/ajax/getresources', 'ModuleController@getResources');
    Route::post('/game/ajax/module/list', 'ModuleController@getInstalledApps');
    Route::post('/game/ajax/economy/getcredits', 'EconomyController@getCredits');

    Route::post('/game/module/{module_name}/ajax/{ajax_call}', 'ModuleController@callAjax');
    Route::get('/game/module/{module_name}/get/{get_call}', 'ModuleController@callGet');

    Route::get('/game/missions/dynamicjs', 'MissionController@getDynamicJS');
    Route::post('/game/missions/checkevent', 'MissionController@checkMissionEvent');

    Route::get('/logout', 'GameController@logout')->name('logout');
});

Route::post('/game/web/{ip}/ajax/{call}', 'GameController@ingameWebAjax');

Route::get('/','GameController@index');

Route::get('/login', 'GameController@login')->name('login');

Route::get('/offline', 'OfflineController@index')->name('offline');

Route::get('/auth/facebook/redirect', 'SocialAuthController@redirect')->name('facebook-auth');
Route::get('/auth/facebook/callback', 'SocialAuthController@callback');

Auth::routes();

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
    Route::get('/game', 'GameController@index');

    Route::post('/game/ajax/module/load', 'ModuleController@loadModule');
    Route::post('/game/ajax/module/unload', 'ModuleController@unloadModule');
    Route::post('/game/ajax/getresources', 'ModuleController@getResources');
    Route::post('/game/ajax/module/list', 'ModuleController@getInstalledApps');
    Route::post('/game/ajax/economy/getcredits', 'EconomyController@getCredits');

    Route::post('/game/module/{module_name}/ajax/{ajax_call}', 'ModuleController@callAjax');
    Route::post('/game/module/{module_name}/get/{get_call}', 'ModuleController@callGet');

    Route::get('/game/missions/dynamicjs', 'MissionController@getDynamicJS');
});

Route::get('/','GameController@index');


Route::get('/login', 'GameController@login');

Route::get('/offline', function () {
    return view('offline');
});

Route::get('/errors/restricted', function () {
    return view('errors.restricted');
});

Auth::routes();
Route::get('/logout', 'GameController@logout');

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

Route::group(['middleware' => ['web', 'authed']], function () {
    Route::get('/test', 'HomeController@test');
});

Route::get('/', function () {
    return view('index');
});

Route::get('/errors/restricted', function () {
    return view('errors.restricted');
});

Auth::routes();

Route::get('/home', 'HomeController@index');

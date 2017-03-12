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
    Route::get('/game', 'GameController@index');
});

Route::get('/','GameController@login');

Route::get('/login', 'GameController@login');

Route::get('/offline', function () {
    return view('offline');
});

Route::get('/errors/restricted', function () {
    return view('errors.restricted');
});

Auth::routes();
Route::get('/logout', 'GameController@logout');

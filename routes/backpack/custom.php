<?php

// --------------------------
// Custom Backpack Routes
// --------------------------
// This route file is loaded automatically by Backpack\Base.
// Routes you generate using Backpack\Generators will be placed here.

Route::group([
    'prefix'     => config('backpack.base.route_prefix', 'admin'),
    'middleware' => ['web', config('backpack.base.middleware_key', 'admin'), 'can:isCreator'],
    'namespace'  => 'App\Http\Controllers\Admin',
], function () { // custom admin routes
    Route::get('content/new-server', 'Content\ServerCreatorController@index')->name('content.servercreator.index');
    Route::get('content/new-server/getport', 'Content\ServerCreatorController@ajaxGetDefaultServicePort')->name('content.servercreator.ajax.getport');
    Route::post('content/new-server', 'Content\ServerCreatorController@store')->name('content.servercreator.store');

    Route::post('user/action', 'UserCrudController@actions')->name('user.actions');
    Route::post('user/getlog', 'UserCrudController@getActivityLogEntry')->name('user.getlog');
});

Route::group([
    'prefix'     => config('backpack.base.route_prefix', 'admin'),
    'middleware' => ['web', config('backpack.base.middleware_key', 'admin'), 'can:isAdmin'],
    'namespace'  => 'App\Http\Controllers\Admin',
], function () { // custom admin routes
    Route::crud('corporation', 'CorporationCrudController');
    Route::crud('bugs', 'BugsCrudController');
    Route::crud('invite', 'InviteCrudController');
    Route::get('charts/weekly-users', 'Charts\WeeklyUsersChartController@response')->name('charts.weekly-users.index');
}); // this should be the absolute last line of this file
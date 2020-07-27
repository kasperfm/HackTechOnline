<?php

Route::group([
    'namespace'  => 'Backpack\PermissionManager\app\Http\Controllers',
    'prefix'     => config('backpack.base.route_prefix', 'admin'),
    'middleware' => ['web', backpack_middleware(), 'can:isAdmin'],
], function () {
    Route::crud('permission', 'PermissionCrudController');
    Route::crud('role', 'RoleCrudController');
});

// Overrides within my own namespace.
Route::group([
    'namespace'  => 'App\Http\Controllers\Admin',
    'prefix'     => config('backpack.base.route_prefix', 'admin'),
    'middleware' => ['web', backpack_middleware(), 'can:isAdmin'],
], function () {
    Route::crud('user', 'UserCrudController');
});
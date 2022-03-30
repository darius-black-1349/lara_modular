<?php

use Illuminate\Support\Facades\Route;

Route::group(
    ['namespace' => 'Darius\RolePermissions\Http\Controllers',
        'middleware' => ['web', 'auth', 'verified']], function ($router) {

    $router->resource('role-permissions', 'RolePermissionsController')
            ->middleware('permission:manage role_permissions');

});

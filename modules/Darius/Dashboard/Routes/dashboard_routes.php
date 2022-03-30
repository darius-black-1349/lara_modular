<?php

use Illuminate\Support\Facades\Route;

Route::group(['namespace' => 'Darius\Dashboard\Http\Controllers',
        'middleware' => ['web', 'auth', 'verified']], function ($router) {

    $router->get('/home', 'DashboardController@home')->name('home');

});

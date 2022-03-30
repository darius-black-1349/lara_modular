<?php

use Illuminate\Support\Facades\Route;
use Darius\User\Models\User;
use Darius\User\Mail\VerifyCodeMail;

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

Route::get('/', function () {
    return view('index');
});

Route::get('/test', function () {
    /*\Spatie\Permission\Models\Permission::create(['name' => 'manage own categories']);
    auth()->user()->givePermissionTo('manage own categories');
    return auth()->user()->permissions;*/

    /*return auth()->user()->assignRole('teacher');*/
});

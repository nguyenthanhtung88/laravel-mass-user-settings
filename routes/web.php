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

Route::get('/', function () {
    $settings = settings();

    return settings('foo');
});

Route::get('settings', function () {
    App\User::first()->settings()->merge(Request::all());

    return redirect('/');
});

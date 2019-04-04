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
    return view('welcome');
});

/*Route::get('/map', function () {
    Route::resource('/club', 'ClubController', ['names' => 'admin.club']);
});*/

Route::resource('/map', 'MapController');

Route::resource('input', 'InputController');
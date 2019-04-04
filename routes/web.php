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
    /*$config = array();
    $config['center'] = 'New York, USA';
    GMaps::initialize($config);
    $map = GMaps::create_map();

    echo $map['js'];
    echo $map['html'];*/


});

/*Route::get('/map', function () {
    Route::resource('/club', 'ClubController', ['names' => 'admin.club']);
});*/

Route::resource('/map', 'MapController');

Route::get('/map2', function () {
    return view('map2');
    /*$config = array();
    $config['center'] = 'New York, USA';
    GMaps::initialize($config);
    $map = GMaps::create_map();

    echo $map['js'];
    echo $map['html'];*/


});

Route::resource('input', 'InputController');
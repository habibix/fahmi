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
Route::resource('report', 'ReportController');
Route::get('data/{id}', 'ReportController@reportView');
/*Route::get('data/{id}', function () {
    return 'Hello World';
});*/
//Route::get('report/{id}', 'ReportController@reportView');

Route::post('select-kab', 'InputController@selectKab')->name('select-kab');
Route::post('select-kec', 'InputController@selectKec')->name('select-kec');


Route::get('/home', 'HomeController@index')->name('home');
Route::get('/home/view/{id}', 'HomeController@single')->name('single');
Route::get('/home/delete/{id}', 'HomeController@delete');

Route::get('/home/export', 'HomeController@export')->name('export');

Auth::routes(['register' => false]);
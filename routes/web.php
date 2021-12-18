<?php

use Illuminate\Support\Facades\Route;

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

// TODO: replace the client routes with a single resource route
Route::post('/clients','App\Http\Controllers\ClientController@store');
Route::put('/clients/{client}','App\Http\Controllers\ClientController@update');
Route::delete('/clients/{client}','App\Http\Controllers\ClientController@destroy');
Route::get('/clients/{client}','App\Http\Controllers\ClientController@show');
Route::get('/clients','App\Http\Controllers\ClientController@index');

Route::resource('/projects','App\Http\Controllers\ProjectController');
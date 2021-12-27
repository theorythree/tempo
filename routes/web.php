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

require __DIR__.'/auth.php';

// ADMIN ROUTES
Route::group(['prefix'=>'dashboard', 'as'=>'dashboard.', 'middleware'=>'is_admin'], function(){
  Route::get('/', function () { return view('dashboard'); })->name('index');
  Route::resource('/clients','App\Http\Controllers\Dashboard\ClientController');
  Route::resource('/projects','App\Http\Controllers\Dashboard\ProjectController');
});

// OWNER ROUTES
Route::group(['middleware'=>'is_owner'], function(){
  
});

// LOGGED IN USER ROUTES
Route::group(['middleware'=>'is_user'], function(){ 
  
});
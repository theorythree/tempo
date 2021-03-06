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
})->name('welcome');

require __DIR__.'/auth.php';

// ADMIN ROLE ROUTES
Route::group(['prefix'=>'dashboard', 'middleware'=>'is_admin'], function(){
  Route::get('/', function () { return view('dashboard'); })->name('dashboard');
});

// OWNER ROLE ROUTES
Route::group(['middleware'=>'is_owner'], function(){ });

// USER ROLE ROUTES
Route::group(['middleware'=>'is_user'], function(){ });

// LOGGED IN USER ROUTES
Route::group(['middleware'=>'auth'], function(){ 
  Route::resource('/clients','App\Http\Controllers\ClientController');
  Route::resource('/projects','App\Http\Controllers\ProjectController');
  Route::resource('/time','App\Http\Controllers\TimeEntryController');
});
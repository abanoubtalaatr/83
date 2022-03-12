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
Route::get('advertising-campaigns', function () {
   return view('create-advertising');
});

Route::get('advertising-campaigns/{id}', function () {
    return view('edit-advertising');
});

Route::get('advertising-campaigns/view/{id}', function (){
   return view('view');
});

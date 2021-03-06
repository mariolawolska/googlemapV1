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

Route::get('/', 'MapController@index');

Route::resource('map', 'MapController');
Route::get('map.lookup', 'MapController@lookup')->name('map.lookup');
Route::put('getNearBy', 'MapController@getNearBy')->name('getNearBy');


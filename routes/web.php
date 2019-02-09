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

Route::get('/', 'IndexController@index');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

// User Profile
Route::get('/profile', 'ProfileController@index');
Route::get('/profile/edit', 'ProfileController@edit');
Route::put('/profile/update', 'ProfileController@update');
Route::get('/profile/init', 'ProfileInitController@init');
Route::get('/@{username}', 'FindUser@profile');

// Ads

Route::resource('ads', 'AdsController');
<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('adsdetails', 'AdDetails@index');
Route::get('adsdetail/{id}', 'AdDetails@show');
Route::post('adsdetails', 'AdDetails@store');
Route::put('adsdetail/{id}', 'AdDetails@update');
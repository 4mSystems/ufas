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



Route::get('settings','Api\userAuthController@settings');

Route::post('login', 'Api\userAuthController@login');

Route::post('check','Api\CheckController@check');

Route::post('upload','Api\uploadController@upload');


Route::post('logout', 'Api\userAuthController@logout');

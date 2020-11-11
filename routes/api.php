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
Route::post('/login', 'API\UserController@login');
Route::post('/register', 'API\UserController@register');
Route::get('/profile', 'API\ProfileController@getProfile')->middleware('auth:api');
Route::post('/editprofile', 'API\ProfileController@editProfile')->middleware('auth:api');
Route::get('/logout', 'API\UserController@logout')->middleware('auth:api');
Route::post('/changepassword','API\UserController@changePassword')->middleware('auth:api');

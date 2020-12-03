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
Route::post('/changepassword', 'API\UserController@changePassword')->middleware('auth:api');
Route::post('/editprofile', 'API\ProfileController@editProfile')->middleware('auth:api');
Route::get('/pemiluprodi', 'API\PemiluController@pemiluProdi')->middleware('auth:api');
Route::get('/pemilufakultas', 'API\PemiluController@pemiluFakultas')->middleware('auth:api');
Route::get('/pemiluuniv', 'API\PemiluController@pemiluUniv')->middleware('auth:api');
Route::post('/cekpin', 'API\VoteController@cekPin')->middleware('auth:api');
Route::post('/cekifvote', 'API\VoteController@checkIfHasVote')->middleware('auth:api');
Route::post('/vote', 'API\VoteController@vote')->middleware('auth:api');
Route::post('/registerpemilu', 'API\PemiluController@register')->middleware('auth:api');
Route::post('/registercalon', 'API\CalonController@register')->middleware('auth:api');
Route::get('/tes','API\UserController@tes');

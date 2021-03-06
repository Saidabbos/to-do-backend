<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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
Route::middleware(['cors'])->group(function () {
    Route::post('signin', 'UserController@login');
    Route::post('signup', 'UserController@registration');
    Route::get('plans', 'PlansController@index')->middleware('auth:api');
    Route::post('plans', 'PlansController@create')->middleware('auth:api');
    Route::delete('plans/{id}', 'PlansController@destroy')->middleware('auth:api');
    Route::put('plans/{id}', 'PlansController@edit')->middleware('auth:api');
});

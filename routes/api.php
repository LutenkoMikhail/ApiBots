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

//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});
Route::group([
    'prefix' => 'v1'
], function () {
    Route::post('login', 'AuthController@login');
    Route::post('registration', 'AuthController@registration');
    Route::post('logout', 'AuthController@logout');
    Route::post('account', 'AuthController@account');
});
Route::group([
    'prefix' => 'v1/bots'
], function () {
    Route::get('index', 'Api\v1\BotController@index');
    Route::get('{id}/show', 'Api\v1\BotController@show');
    Route::post('{id}/destroy', 'Api\v1\BotController@destroy');
    Route::post('create', 'Api\v1\BotController@store');


});

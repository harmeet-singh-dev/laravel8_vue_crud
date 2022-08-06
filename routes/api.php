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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::group(['prefix' => 'v1', 'middleware' => 'auth:api'], function(){
Route::get('/user/setup-intent', 'API\UserController@getSetupIntent');
Route::post('/user/payments', 'API\UserController@postPaymentMethods');
Route::get('/user/payment-methods', 'API\UserController@getPaymentMethods');
Route::post('/user/remove-payment', 'API\UserController@removePaymentMethod');
Route::put('/user/subscription', 'API\UserController@updateSubscription');
});



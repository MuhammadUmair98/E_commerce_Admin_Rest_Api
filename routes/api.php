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

Route::get('/get/all/marts','apiController@getMarts');
Route::post('/get/orders','apiController@getOrders');
Route::post('/store/ratings','apiController@storeRatings');
Route::post('/get/specific/orders/with/email','apiController@getSpecificOrders');
Route::post('/post/all/category/subcategory','apiController@getCategory');
Route::middleware('auth:api')->post('/post/all/products','apiController@getProducts');
Route::group([
    'prefix' => 'auth'
], function () {
    Route::post('/user/login', 'AuthController@login');
    Route::post('/user/signup', 'AuthController@signup');

    Route::group([
      'middleware' => 'auth:api'
    ], function() {
        Route::get('logout', 'AuthController@logout');
        Route::get('user', 'AuthController@user');
    });
});

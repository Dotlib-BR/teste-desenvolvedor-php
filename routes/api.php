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

Route::middleware('api')->namespace('API')->group(function() {

    # Users
    Route::resource('users', 'UserController')->except(['create', 'edit']);

    # Products
    Route::resource('products', 'ProductController');

    # Orders
    Route::resource('orders', 'OrderController');

});

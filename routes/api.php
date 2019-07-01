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

Route::group(['namespace' => 'API', 'middleware' => 'api'], function() {

    # Users
    Route::resource('users', 'UserController')->except(['create', 'edit']);

    # Products
    Route::resource('products', 'ProductController')->except(['create', 'edit']);

    # Orders
    Route::resource('orders', 'OrderController')->except(['create', 'edit']);
    Route::get('orders/user/{id}', 'OrderController@userOrders');

});

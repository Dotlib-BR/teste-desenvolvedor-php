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


Route::prefix('users')->group(function() {
    Route::get('/', 'UserController@index');
    Route::post('/', 'UserController@store');
    Route::delete('/', 'UserController@delete');

    Route::prefix('{id}')->group(function () {
        Route::put('/', 'UserController@update');
        Route::delete('/', 'UserController@delete');
        Route::get('/', 'UserController@show');
    });
});

Route::prefix('orders')->group(function() {
    Route::get('/', 'OrderController@index');
    Route::post('/', 'OrderController@store');
    Route::delete('/', 'OrderController@delete');

    Route::prefix('{id}')->group(function () {
        Route::put('/', 'OrderController@update');
        Route::delete('/', 'OrderController@delete');
        Route::get('/', 'OrderController@show');
    });
});

Route::prefix('products')->group(function() {
    Route::get('/', 'ProductController@index');
    Route::post('/', 'ProductController@store');
    Route::delete('/', 'ProductController@delete');

    Route::prefix('{id}')->group(function () {
        Route::put('/', 'ProductController@update');
        Route::delete('/', 'ProductController@delete');
        Route::get('/', 'ProductController@show');
    });
});
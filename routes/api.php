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

Route::middleware('api')
    ->namespace('Api\V1')
    ->prefix('v1')
    ->group(function () {

        Route::prefix('clients')
            ->group(function () {
                Route::get('list', 'ClientController@list');
                Route::get('{client}', 'ClientController@show');
                Route::post('', 'ClientController@store');
                Route::put('{client}', 'ClientController@update');
                Route::delete('{client}', 'ClientController@destroy');
            });

        Route::prefix('products')
            ->group(function () {
                Route::get('list', 'ProductController@list');
                Route::get('{product}', 'ProductController@show');
                Route::post('', 'ProductController@store');
                Route::put('{product}', 'ProductController@update');
                Route::delete('{product}', 'ProductController@destroy');
            });
            
        Route::prefix('orders')
            ->group(function () {
                Route::get('list/{client?}', 'OrderController@list');
                Route::get('{order}', 'OrderController@show');
                Route::post('', 'OrderController@store');
                Route::put('{order}', 'OrderController@update');
                Route::delete('{order}', 'OrderController@destroy');
            });
            
    });

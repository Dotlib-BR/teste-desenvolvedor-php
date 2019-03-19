<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::resource('clients', 'ClientController');
Route::resource('products', 'ProductController');
Route::resource('orders', 'OrderController');

Route::get('/orders/new/getproduct', ['as' => 'search.product', 'uses' => 'ProductController@getProduct']);
Route::post('/orders/updateqtt', ['as' => 'update.qtt', 'uses' => 'OrderController@updateQtt']);
Route::get('/orders/deleteprod/{orderid}/{productid}', ['as' => 'delete.product', 'uses' => 'OrderController@deleteProd']);



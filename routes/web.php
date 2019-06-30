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

Route::group(['namespace' => 'Auth'], function() {

    # Log In & Log Out
    Route::post('login', 'LoginController@login')->name('login');
    Route::get('logout', 'LoginController@logout')->name('logout');

});

Route::group(['namespace' => 'Page'], function () {

    # Home
    Route::get('/', 'HomeController@index')->name('home');

    # Users
    Route::resource('users', 'UserController');
    Route::post('users/mass-destroy', 'UserController@massDestroy')->name('users.mass-destroy');

    # Products
    Route::resource('products', 'ProductController');
    Route::post('products/mass-destroy', 'ProductController@massDestroy')->name('products.mass-destroy');

    # Orders
    Route::resource('orders', 'OrderController');
    Route::post('orders/mass-destroy', 'OrderController@massDestroy')->name('orders.mass-destroy');

});

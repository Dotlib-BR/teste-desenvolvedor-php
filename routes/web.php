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

Auth::routes([
    'register' => false
]);

Route::middleware(['auth'])
    ->group(function () {
        Route::get('/', 'HomeController@index')->name('home');

        // Clients
        Route::resource('clients', 'ClientController');

        // Products
        Route::resource('products', 'ProductController');

        // Orders
        Route::get('orders/add-to-cart', 'OrderController@addToCart');
        Route::get('orders/remove-from-cart', 'OrderController@removeFromCart');
        Route::get('orders/filter', 'OrderController@filter')->name('orders.filter');
        Route::get('orders/paginate', 'OrderController@paginate')->name('orders.paginate');
        Route::resource('orders', 'OrderController');
});

<?php

use Illuminate\Support\Facades\Route;

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

// User Logged Routes
Route::prefix('/')->middleware('checkLogged')->group(function () {

    Route::get('/', 'UserController@index')->name('home');
    Route::get('config', 'UserController@editView')->name('config');
    Route::put('config', 'UserController@update')->name('validateConfig');

    Route::prefix('orders')->group(function () {

        Route::get('/', 'OrderController@index')->name('order');
        Route::get('/clear', 'OrderController@clearCart')->name('clear');
        Route::get('/finish', 'OrderController@finish')->name('finishOrder');
        Route::post('/cart', 'OrderController@cartStore');
        Route::post('/', 'OrderController@store')->name('storeOrder');

        
        Route::prefix('{id}')->group(function () {
            Route::put('/', 'OrderController@update')->name('orderUpdate');
            Route::get('/', 'OrderController@show')->name('showOrder');
        });
    });

    Route::prefix('products')->group(function () {

        Route::get('/', 'ProductController@index')->name('products');

        Route::prefix('{id}')->group(function () {

            Route::get('/', 'ProductController@show')->name('showProduct');
        });
    });
});

// Admin Logged Routes
Route::prefix('admin')->middleware('checkLoggedAdmin')->group(function () {
    Route::get('/', 'AdminController@index')->name('adminHome');

    Route::prefix('produto')->group(function () {

        Route::get('/register', 'ProductController@registerView')->name('registerView');
        Route::post('/register', 'ProductController@store')->name('storeProduct');
        Route::delete('/', 'ProductController@delete');
        
        Route::prefix('{id}')->group(function () {
            Route::delete('/', 'ProductController@delete');
            Route::get('/', 'ProductController@editView')->name('editProduct');
            Route::put('/', 'ProductController@update')->name('updateProduct');
        });
    });
    
    Route::prefix('pedido')->group(function () {

        Route::delete('/', 'OrderController@delete');

        Route::prefix('{id}')->group(function () {
            Route::delete('/', 'OrderController@delete');
            Route::get('/', 'OrderController@showAdmin')->name('showAdmin');
            Route::put('/', 'OrderController@update')->name('updateOrderAdmin');
        });
    });
});

// Login User Routes
Route::get('/login', 'UserController@loginView')->name('login');
Route::post('/login', 'UserController@login')->name('validateLogin');
Route::get('/logout', 'UserController@logout')->name('logout');

// Register User Routes
Route::get('/register', 'UserController@registerView')->name('register');
Route::post('/register', 'UserController@store')->name('registerValidate');

// Login Admin Routes
Route::get('/admin-login', 'AdminController@loginView')->name('loginAdmin');
Route::post('/admin-login', 'AdminController@login')->name('validateLoginAdmin');
Route::get('/admin-logout', 'AdminController@logout')->name('logoutAdmin');

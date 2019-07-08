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

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

// Route Public
Route::middleware('guest')
    ->group(function () {

        Route::get('/', function () {
            return view('auth.login');
        });
    });

Auth::routes();

// Routes Private
Route::namespace('Dashboard')
    ->middleware('auth')
    ->as('dashboard.')
    ->prefix('/dashboard')->group( function(){

        Route::get('/home', 'IndexController@home')
            ->name('index.home');

        Route::resource('clients', 'ClientController');// CRUD de clientes
        Route::resource('purchases', 'PurchaseController');// CRUD de pedidos de compra
        Route::resource('products', 'ProductController');// CRUD de produtos
    });

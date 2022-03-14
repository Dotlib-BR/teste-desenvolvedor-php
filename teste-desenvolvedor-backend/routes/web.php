<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
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

//Signup
Route::get('/signup', [AuthController::class, 'signup'])->name('signup');
Route::post('/signup', [AuthController::class, 'register'])->name('signup.post');

//Login
Route::get('/login', [AuthController::class, 'index'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');

//Logout
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

Route::prefix('/')->middleware("auth:web")->group(function () {

    Route::get('/', function () {
        return view('welcome');
    })->name('welcome');

    //Route::get('/pedidos', [OrderController::class, 'index'])->name('orders.index');
    Route::resource('/pedidos', OrderController::class);
    Route::post('/pedidos/search', [OrderController::class, 'search'])->name('orders.search');


    Route::resource('/produtos', ProductController::class);
    Route::post('/produtos/search', [ProductController::class, 'search'])->name('products.search');


    Route::resource('/clientes', ClientController::class);
    Route::post('/clientes/search', [ClientController::class, 'search'])->name('clients.search');

});


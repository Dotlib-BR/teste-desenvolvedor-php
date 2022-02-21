<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;

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
    return view('home');
})->name('home');

Route::get('/login', function () {
    return view('login');
})->name('login.user');

Route::get('/register', function () {
    return view('register');
})->name('register.user');

Route::get('/about', function () {
    return view('about');
})->name('about');



Route::group(['middleware' => 'authentic'], function () {
    Route::get('/products/{filter}', [\App\Http\Controllers\ProductsController::class, 'index'])->name('products');

    Route::get('/requests/{filter}', [\App\Http\Controllers\RequestsController::class, 'index'])->name('requests');
    Route::post('/request', [\App\Http\Controllers\RequestsController::class, 'store'])->name('add.request');
    Route::get('/ajax/request/get/{id}', [\App\Http\Controllers\RequestsController::class, 'showAjax'])->name('get.request.ajax');
    Route::get('/ajax/request/delete/{id}', [\App\Http\Controllers\RequestsController::class, 'destroyAjax'])->name('delete.request.ajax');
    Route::get('/ajax/product/get/{id}', [\App\Http\Controllers\ProductsController::class, 'showAjax']);
    Route::get('/ajax/request/user/get/{id}', [\App\Http\Controllers\RequestsController::class, 'getRequestByUser']);

    Route::get('/ajax/orders/get/{id}', [\App\Http\Controllers\RequestsController::class, 'listOrdersByRequestAjax']);
    Route::get('/ajax/orders/post/', [\App\Http\Controllers\RequestsController::class, 'addOrderInRequestAjax']);
});


Route::group(['middleware' => 'admin'], function () {
    Route::get('/clients/{filter}', [\App\Http\Controllers\ClientsController::class, 'index']);
    Route::get('/ajax/clients/get/{id}', [\App\Http\Controllers\ClientsController::class, 'showAjax'])->name('get.client.ajax');
    Route::get('/ajax/clients/delete/{id}', [\App\Http\Controllers\ClientsController::class, 'destroyAjax'])->name('delete.client.ajax');

    Route::post('/product', [\App\Http\Controllers\ProductsController::class, 'store'])->name('add.product');
    Route::get('ajax/product/update/{id}', [\App\Http\Controllers\ProductsController::class, 'updateAjax'])->name('update.product');
    Route::get('/ajax/products/delete/{id}', [\App\Http\Controllers\ProductsController::class, 'destroyAjax']);
});


Route::post('/login', [LoginController::class, 'login'])->name('action.login');
Route::post('/register', [LoginController::class, 'register'])->name('action.register');
Route::get('/logout', [LoginController::class, 'logout'])->name('action.logout');

<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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

Auth::routes();

Route::middleware(['auth'])->group(function () {
    //Basic routes
    Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::get('/delete/user/{id}', [App\Http\Controllers\HomeController::class, 'excluir'])->name('remove.user');
    Route::get('/delete/order/{id}', [App\Http\Controllers\OrderController::class, 'excluir'])->name('order.remove');
    Route::get('/user/create', [App\Http\Controllers\HomeController::class, 'create'])->name('create.user');
    Route::post('/user/create', [App\Http\Controllers\HomeController::class, 'store'])->name('store.user');
    Route::get('/user/edit/{id}', [App\Http\Controllers\HomeController::class, 'edit'])->name('edit.user');
    Route::put('/user/update/{id}', [App\Http\Controllers\HomeController::class, 'update'])->name('update.user');
    Route::delete('/discount/forget', [App\Http\Controllers\DiscountCouponController::class, 'forget'])->name('discount.forget');
    
    //Filters routes
    Route::get('/users/search', [App\Http\Controllers\HomeController::class, 'search'])->name('search');
    Route::get('/product/search', [App\Http\Controllers\ProductController::class, 'search'])->name('product.search');
    Route::get('/orders/search', [App\Http\Controllers\OrderController::class, 'search'])->name('order.search');
    Route::get('/ver/search', [App\Http\Controllers\MyOrderController::class, 'search'])->name('details.search');
    
    //Routes to delete checked box
    Route::delete('/users/delete/checked', [App\Http\Controllers\HomeController::class, 'removeLot'])->name('remove.lot');
    Route::delete('/product/delete/checked', [App\Http\Controllers\ProductController::class, 'removeLot'])->name('product.lot');
    Route::delete('/order/delete/checked', [App\Http\Controllers\OrderController::class, 'removeLot'])->name('orders.lot');

    //Resource routes
    Route::resource('/product', App\Http\Controllers\ProductController::class);
    Route::resource('/orders', App\Http\Controllers\OrderController::class);
    Route::resource('/discount', App\Http\Controllers\DiscountCouponController::class);
    Route::resource('/ver', App\Http\Controllers\MyOrderController::class);
});
<?php

use App\Http\Controllers\Web\ClientController;
use App\Http\Controllers\Web\DiscountController;
use App\Http\Controllers\Web\OrderController;
use App\Http\Controllers\Web\ProductController;
use App\Models\Order;
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

Route::get('/', function () {
    return redirect()->route('clients');
});


Route::get('/clients/{id}/edit', [ClientController::class, 'updatePage'])->name('createPage', 'yoooo');
Route::resource('/clients', ClientController::class)
    ->name('index', 'clients');
Route::get('/clients/create', [ClientController::class, 'createPage'])->name('createPage', 'yoooo');


Route::resource('/products', ProductController::class);
Route::resource('/orders', OrderController::class);
Route::resource('/discounts', DiscountController::class);
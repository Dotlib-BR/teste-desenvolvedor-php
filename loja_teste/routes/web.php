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

Route::get('/', function () {
    return view('home');
})->name('home');

// Clientes
Route::get('/client/list', [\App\Http\Controllers\ClienteController::class, 'getClient'])->name("client.get.list");
Route::get('/client/detail/{id}', [\App\Http\Controllers\ClienteController::class, 'getClientDetail'])->name("client.get.detail");

Route::get('/client/create', [\App\Http\Controllers\ClienteController::class, 'getClientCreate'])->name("client.get.create");
Route::post('/client/create', [\App\Http\Controllers\ClienteController::class, 'postClientCreate'])->name("client.post.create");

Route::get('/client/edit/{id}', [\App\Http\Controllers\ClienteController::class, 'getClientEdit'])->name("client.get.edit");
Route::put('/client/edit/{id}', [\App\Http\Controllers\ClienteController::class, 'putClientEdit'])->name("client.put.edit");

Route::put('/client/delete/{id}', [\App\Http\Controllers\ClienteController::class, 'putClientDeactive'])->name("client.put.deactive")->withTrashed();

//Produtos
Route::get('/product/list', [\App\Http\Controllers\ProductController::class, 'getProduct'])->name("product.get.list");
Route::get('/product/detail/{id}', [\App\Http\Controllers\ProductController::class, 'getProductDetail'])->name("product.get.detail");

Route::get('/product/create', [\App\Http\Controllers\ProductController::class, 'getProductCreate'])->name("product.get.create");
Route::post('/product/create', [\App\Http\Controllers\ProductController::class, 'postProductCreate'])->name("product.post.create");

Route::get('/product/edit/{id}', [\App\Http\Controllers\ProductController::class, 'getProductEdit'])->name("product.get.edit");
Route::put('/product/edit/{id}', [\App\Http\Controllers\ProductController::class, 'putProductEdit'])->name("product.put.edit");

Route::put('/product/delete/{id}', [\App\Http\Controllers\ProductController::class, 'putProductDeactive'])->name("product.put.deactive")->withTrashed();

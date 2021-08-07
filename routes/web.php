<?php

use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\ClienteController;
use \App\Http\Controllers\ProdutoController;
use \App\Http\Controllers\PedidoController;
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

Route::get('/',[ClienteController::class, 'index'])->name('cliente.index');


Route::group([
    'prefix' => 'cliente'
], function () {
    Route::get('/edit/{id}',[ClienteController::class, 'edit'])->name('cliente.edit');
    Route::put('/edit/{id}',[ClienteController::class, 'update'])->name('cliente.update');
    Route::get('/create',[ClienteController::class, 'create'])->name('cliente.create');
    Route::post('/store',[ClienteController::class, 'store'])->name('cliente.store');
    Route::delete('/delete/{id}',[ClienteController::class, 'destroy'])->name('cliente.delete');
});

Route::group([
    'prefix' => 'produto'
], function () {
    Route::get('/',[ProdutoController::class, 'index'])->name('produto.index');
    Route::get('/edit/{id}',[ProdutoController::class, 'edit'])->name('produto.edit');
    Route::put('/edit/{id}',[ProdutoController::class, 'update'])->name('produto.update');
    Route::get('/create',[ProdutoController::class, 'create'])->name('produto.create');
    Route::post('/store',[ProdutoController::class, 'store'])->name('produto.store');
    Route::delete('/delete/{id}',[ProdutoController::class, 'destroy'])->name('produto.delete');
});

Route::group([
    'prefix' => 'pedidos'
], function () {
    Route::get('/',[PedidoController::class, 'index'])->name('pedido.index');
    Route::get('/edit/{id}',[PedidoController::class, 'edit'])->name('pedido.edit');
    Route::put('/edit/{id}',[PedidoController::class, 'update'])->name('pedido.update');
    Route::get('/create',[PedidoController::class, 'create'])->name('pedido.create');
    Route::post('/store',[PedidoController::class, 'store'])->name('pedido.store');
    Route::delete('/delete/{id}',[PedidoController::class, 'destroy'])->name('pedido.delete');
});

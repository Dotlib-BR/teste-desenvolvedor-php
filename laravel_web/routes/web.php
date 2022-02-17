<?php

use App\Http\Controllers\ClientesController;
use App\Http\Controllers\PedidosController;
use App\Http\Controllers\ProdutosController;
use Illuminate\Support\Facades\Auth;
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
    return view('welcome');
});

Route::prefix('clientes')->group(function() {
    Route::get('/', [ClientesController::class, 'index'])->name('clientes-index')->middleware('auth');
    Route::get('/create', [ClientesController::class, 'create'])->name('clientes-create')->middleware('auth');
    Route::post('/', [ClientesController::class, 'store'])->name('clientes-store')->middleware('auth');
    Route::get('/{id}', [ClientesController::class, 'show'])->where('id', '[0-9]+')->name('clientes-show')->middleware('auth');
    Route::get('/{id}/edit', [ClientesController::class, 'edit'])->where('id', '[0-9]+')->name('clientes-edit')->middleware('auth');
    Route::put('/{id}', [ClientesController::class, 'update'])->where('id', '[0-9]+')->name('clientes-update')->middleware('auth');
    Route::delete('/{id}', [ClientesController::class, 'destroy'])->where('id', '[0-9]+')->name('clientes-destroy')->middleware('auth');
});

Route::prefix('produtos')->group(function() {
    Route::get('/', [ProdutosController::class, 'index'])->name('produtos-index')->middleware('auth');
    Route::get('/create', [ProdutosController::class, 'create'])->name('produtos-create')->middleware('auth');
    Route::post('/', [ProdutosController::class, 'store'])->name('produtos-store')->middleware('auth');
    Route::get('/{id}', [ProdutosController::class, 'show'])->where('id', '[0-9]+')->name('produtos-show')->middleware('auth');
    Route::get('/{id}/edit', [ProdutosController::class, 'edit'])->where('id', '[0-9]+')->name('produtos-edit')->middleware('auth');
    Route::put('/{id}', [ProdutosController::class, 'update'])->where('id', '[0-9]+')->name('produtos-update')->middleware('auth');
    Route::delete('/{id}', [ProdutosController::class, 'destroy'])->where('id', '[0-9]+')->name('produtos-destroy')->middleware('auth');
});

Route::prefix('pedidos')->group(function() {
    Route::get('/', [PedidosController::class, 'index'])->name('pedidos-index')->middleware('auth');
    Route::get('/create', [PedidosController::class, 'create'])->name('pedidos-create')->middleware('auth');
    Route::post('/', [PedidosController::class, 'store'])->name('pedidos-store')->middleware('auth');
    Route::get('/{id}', [PedidosController::class, 'show'])->where('id', '[0-9]+')->name('pedidos-show')->middleware('auth');
    Route::get('/{id}/edit', [PedidosController::class, 'edit'])->where('id', '[0-9]+')->name('pedidos-edit')->middleware('auth');
    Route::put('/{id}', [PedidosController::class, 'update'])->where('id', '[0-9]+')->name('pedidos-update')->middleware('auth');
    Route::delete('/{id}', [PedidosController::class, 'destroy'])->where('id', '[0-9]+')->name('pedidos-destroy')->middleware('auth');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
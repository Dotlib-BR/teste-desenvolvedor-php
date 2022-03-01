<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\ProdutoController;
use App\Http\Controllers\PedidoController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('cliente', [ClienteController::class, 'index']);
Route::post('cliente', [ClienteController::class, 'store']);
Route::get('detalhesDoCliente/{id}',[ClienteController::class, 'show'])->name('detalhesDoCliente');
Route::get('editarCliente/{id}',[ClienteController::class, 'showEdit'])->name('editarCliente');
Route::post('editarCliente/{id}',[ClienteController::class, 'update'])->name('editarCliente');
Route::post('cliente/{id}', [ClienteController::class,'destroy'])->name('cliente');

Route::get('produto', [ProdutoController::class, 'index']);
Route::post('produto', [ProdutoController::class, 'store']);
Route::get('detalhesDoProduto/{id}',[ProdutoController::class, 'show'])->name('detalhesDoProduto');
Route::get('editarProduto/{id}',[ProdutoController::class, 'showEdit'])->name('editarProduto');
Route::post('editarProduto/{id}',[ProdutoController::class, 'update'])->name('editarProduto');
Route::post('produto/{id}', [ProdutoController::class,'destroy'])->name('produto');

Route::get('cadastrarPedido', [PedidoController::class, 'index']);
Route::get('pedido', [PedidoController::class, 'indexPedidos']);
Route::post('cadastrarPedido', [PedidoController::class, 'store']);
Route::get('detalhesCliente/{id}',[ClienteController::class, 'showPedido'])->name('detalhesCliente');
Route::get('detalhesDoPedido/{id}',[PedidoController::class, 'show'])->name('detalhesDoPedido');
Route::get('editarPedido/{id}',[PedidoController::class, 'showEdit'])->name('editarPedido');
Route::post('editarPedido/{id}',[PedidoController::class, 'update'])->name('editarPedido');
Route::post('pedido/{id}', [PedidoController::class,'destroy'])->name('pedido');
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

Route::prefix('/cliente')->group(function(){
    Route::get('/listar/{id}', [ClienteController::class, 'showOneCliente'])->name('api.show.one.cliente');
    Route::post('/listar', [ClienteController::class, 'showAllCliente'])->name('api.show.all.cliente');
    Route::post('/cadastro', [ClienteController::class, 'createCliente'])->name('api.create.cliente');
    Route::put('/atualizar/{id}', [ClienteController::class, 'updateCliente'])->name('api.update.cliente');
    Route::delete('/deletar/{id}', [ClienteController::class, 'deleteCliente'])->name('api.delete.cliente');
});


Route::prefix('/produto')->group(function(){
    Route::get('/listar/{id}', [ProdutoController::class, 'showOneProduto'])->name('api.show.one.produto');
    Route::post('/listar', [ProdutoController::class, 'showAllProduto'])->name('api.show.all.produto');
    Route::post('/cadastro', [ProdutoController::class, 'createProduto'])->name('api.create.produto');
    Route::put('/atualizar/{id}', [ProdutoController::class, 'updateProduto'])->name('api.update.produto');
    Route::delete('/deletar/{id}', [ProdutoController::class, 'deleteProduto'])->name('api.delete.produto');
});

Route::prefix('/pedido')->group(function(){
    Route::get('/listar/{id}', [PedidoController::class, 'showOnePedido'])->name('api.show.one.pedido');
    Route::post('/listar', [PedidoController::class, 'showAllPedido'])->name('api.show.all.pedido');
    Route::post('/cadastro', [PedidoController::class, 'createPedido'])->name('api.create.pedido');
    Route::put('/atualizar/{id}', [PedidoController::class, 'updatePedido'])->name('api.update.pedido');
    Route::put('/pagar/{id}', [PedidoController::class, 'payPedido'])->name('api.pay.pedido');
    Route::put('/cancelar/{id}', [PedidoController::class, 'cancelPedido'])->name('api.cancel.pedido');
    Route::delete('/deletar/{id}', [PedidoController::class, 'deletePedido'])->name('api.delete.pedido');
});

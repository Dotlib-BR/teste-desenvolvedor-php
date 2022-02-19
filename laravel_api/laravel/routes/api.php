<?php

use App\Http\Controllers\ClientsController;
use App\Http\Controllers\homeController;
use App\Http\Controllers\PedidosController;
use App\Http\Controllers\ProductsController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

/* Rota Home */
Route::get('/home', [homeController::class, 'index']);

/* Rotas Clientes */
Route::get('/clients', [ClientsController::class, 'all']);
Route::post('/clients/adicionar', [ClientsController::class, 'add']);
Route::get('/clients/show/{client}', [ClientsController::class, 'show']);
Route::get('/clients/edit/{client}', [ClientsController::class, 'serchID']);
Route::put('/clients/update/{client}', [ClientsController::class, 'update']);
Route::delete('/clients/delete/{client}', [ClientsController::class, 'delete']);

/* Rotas Produtos */
Route::get('/products', [ProductsController::class, 'all']);
Route::post('/products/adicionar', [ProductsController::class, 'add']);
Route::get('/products/show/{product}', [ProductsController::class, 'show']);
Route::get('/products/edit/{product}', [ProductsController::class, 'serchID']);
Route::put('/products/update/{product}', [ProductsController::class, 'update']);
Route::delete('/products/delete/{product}', [ProductsController::class, 'delete']);

/* Rotas Pedidos */
Route::get('/pedidos', [PedidosController::class, 'all']);
Route::get('/pedidos/create', [PedidosController::class, 'create']);
Route::post('/pedidos/adicionar', [PedidosController::class, 'add']);
Route::get('/pedidos/show/{pedido}', [PedidosController::class, 'show']);
Route::get('/pedidos/edit/{pedido}', [PedidosController::class, 'serchID']);
Route::put('/pedidos/update/{pedido}', [PedidosController::class, 'update']);
Route::delete('/pedidos/delete/{pedido}', [PedidosController::class, 'delete']);

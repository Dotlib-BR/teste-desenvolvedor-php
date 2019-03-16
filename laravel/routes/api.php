<?php

use Illuminate\Http\Request;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get("/pedidos",'PedidoController@pedidos');
Route::get("/produtos",'ProdutoController@produtos');
Route::post("/produto",'ProdutoController@storage');
Route::delete("/produto/{id}",'ProdutoController@delete');


Route::get("/clientes",'ClienteController@clientes');
Route::post("/cliente",'ClienteController@storage');
Route::delete("/cliente/{id}",'ClienteController@delete');

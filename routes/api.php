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

Route::get('/clientes', 'ClienteController@getAll');
Route::get('/clientes/{cliente}', 'ClienteController@get');
Route::post('/clientes', 'ClienteController@createNew');
Route::put('/clientes/{cliente}', 'ClienteController@update');
Route::delete('/clientes/{cliente}', 'ClienteController@delete');

Route::get('/produtos', 'ProdutoController@getAll');
Route::get('/produtos/{produto}', 'ProdutoController@get');
Route::post('/produtos', 'ProdutoController@createNew');
Route::put('/produtos/{produto}', 'ProdutoController@update');
Route::delete('/produtos/{produto}', 'ProdutoController@delete');

Route::get('/pedidos', 'PedidoController@getAll');
Route::get('/pedidos/{pedido}', 'PedidoController@get');
Route::post('/pedidos', 'PedidoController@createNew');
Route::put('/pedidos/{pedido}', 'PedidoController@update');
Route::delete('/pedidos/{pedido}', 'PedidoController@delete');
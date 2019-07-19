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
Route::resources([
    'cliente' => 'Api\ClienteController',
    'produto' => 'Api\ProdutoController',
    'desconto'=> 'Api\DescontoController'
]);
Route::prefix('itenspedido')->group(function(){
    Route::get('/{pedido}', 'Api\ItensPedidoController@index');
    Route::post('/', 'Api\ItensPedidoController@store');
    Route::delete('/', 'Api\ItensPedidoController@destroy');
});

Route::prefix('pedido')->group(function(){
    Route::get('/', 'Api\PedidoController@index');
    Route::get('/{pedido}', 'Api\PedidoController@show');
    Route::post('/desconto','Api\PedidoController@desconto');
    Route::put('/{pedido}','Api\PedidoController@update');
    Route::delete('/{pedido}','Api\PedidoController@destroy');
});


/*Route::prefix('cliente')->group(function(){
    Route::get('/', 'Api\ClienteController@index');
    Route::post('/store', 'Api\ClienteController@store');
    Route::put('/{cliente}', 'Api\ClienteController@update');
    Route::get('/{cliente}', 'Api\ClienteController@show');
    Route::delete('/{cliente}', 'Api\ClienteController@destroy');
});*/


<?php

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

Route::get('/', 'LoginController@login')->name('login');
Route::get('/login', 'LoginController@login');
Route::get('/logout', 'LoginController@logout');
Route::post('/authenticate', 'LoginController@authenticate');

Route::group(['prefix' => 'dashboard',  'middleware' => 'auth'], function () {
    Route::get('/', 'DashboardController@home');
    Route::get('/produto', 'DashboardController@produto');
    Route::get('/cliente', 'DashboardController@cliente');
    Route::get('/pedido', 'DashboardController@pedido');
});



Route::group(['prefix' => 'api',  'middleware' => 'auth'], function () {
    Route::get("/pedidos", 'PedidoController@pedidos');
    Route::post("/pedido", 'PedidoController@storage');
    Route::post("/pedido-detalhe", 'PedidoController@pedidoProduto');
    Route::put("/pedido-pagamento", 'PedidoController@pagamento');


    Route::get("/produtos", 'ProdutoController@produtos');
    Route::post("/produto", 'ProdutoController@storage');
    Route::delete("/produto/{id}", 'ProdutoController@delete');


    Route::get("/clientes", 'ClienteController@clientes');
    Route::post("/cliente", 'ClienteController@storage');
    Route::delete("/cliente/{id}", 'ClienteController@delete');
});


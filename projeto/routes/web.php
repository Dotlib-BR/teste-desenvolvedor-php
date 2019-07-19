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

Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['middleware'=>'admin','namespace'=>'Mvc'], function(){
    Route::prefix('produto')->group(function(){        
        Route::post('/delete', 'ProdutoController@destroy')->name('produtos.delete');        
        Route::get('/create', 'ProdutoController@create')->name('produtos.create');
        Route::post('/', 'ProdutoController@store')->name('produtos.store');                  
        Route::get('/{id}/edit','ProdutoController@editar')->name('produtos.edit');        
    });
    Route::prefix('cliente')->group(function(){
        Route::post('/delete', 'ClienteController@destroy')->name('clientes.delete');        
        Route::get('/create', 'ClienteController@create')->name('clientes.create');
    });
    Route::prefix('desconto')->group(function(){
        Route::get('/', 'DescontoController@index')->name('descontos');
        Route::get('/create', 'DescontoController@create')->name('descontos.create');       
        Route::post('/', 'DescontoController@store')->name('descontos.store');  
        Route::get('/{desconto}', 'DescontoController@show')->name('descontos.show');     
        Route::post('/delete', 'DescontoController@delete')->name('descontos.delete');         
    });
});
Route::group(['middleware'=>'auth','namespace'=>'Mvc'], function(){ 
    Route::prefix('produto')->group(function(){
        Route::get('/','ProdutoController@index')->name('produtos');
        Route::get('/{id}','ProdutoController@show')->name('produtos.show');
    });    
    Route::prefix('cliente')->group(function(){               
        Route::get('/', 'ClienteController@index')->name('clientes');                
        Route::post('/', 'ClienteController@store')->name('clientes.store');        
        Route::get('/{id}', 'ClienteController@show')->name('clientes.show');               
    });
    Route::prefix('pedido')->group(function(){       
        Route::get('/','PedidoController@index')->name('pedidos');  
        Route::post('/', 'PedidoController@store')->name('pedidos.store'); 
        Route::get('/{id}','PedidoController@show')->name('pedidos.show');              
        Route::get('/create/{cliente?}', 'PedidoController@create')->name('pedidos.create');                
        Route::post('/delete', 'PedidoController@delete')->name('pedidos.delete');       
    });
    Route::prefix('itens')->group(function(){
        Route::get('/{pedido}/index', 'ItensPedidoController@index')->name('itens.index');
        Route::post('/adicionar', 'ItensPedidoController@adicionar')->name('itens.adicionar');
        Route::post('/remover', 'ItensPedidoController@deletar')->name('itens.deletar');
        Route::post('/desconto', 'ItensPedidoController@desconto')->name('itens.desconto');
    });
   
});

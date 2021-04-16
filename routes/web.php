<?php

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


Route::get('/','App\Http\Controllers\Controller@index')->name('index');
Route::get('/produtos/{slug}','App\Http\Controllers\Controller@produtos')->name('produtos-frontend');
Route::get('/seguro/meu-carrinho','App\Http\Controllers\Controller@carrinho')->name('produtos-carrinho');
Route::get('/teste', function() {

    Carrinho::teste();

});
/* Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard'); */

//Grupo de rotas para usuários normais/clientes
Route::middleware(['auth:sanctum','verified'])->group(function(){
	Route::get('usuario/dashboard','App\Http\Controllers\ClienteController@dashboard')->name('ClienteDashboard');
    Route::get('/seguro/meu-carrinho/checkout','App\Http\Controllers\ClienteController@checkout')->name('checkout');
    Route::get('/seguro/meu-carrinho/checkout/status/{status}','App\Http\Controllers\ClienteController@compraStatus')->name('checkoutStatus');
    Route::get('/usuario/dashboard/compras','App\Http\Controllers\ClienteController@compraLista')->name('lista-compras');
    Route::get('/usuario/dashboard/compra/{id}','App\Http\Controllers\ClienteController@showCompra')->name('compra');
});



//Grupo de rotas para Admins
Route::middleware(['auth:sanctum','verified','authadmin'])->group(function(){
	Route::get('admin/dashboard','App\Http\Controllers\AdminController@dashboard')->name('adminDashboard');
    Route::resource('admin/dashboard/produtos', 'App\Http\Controllers\ProdutoController');
    Route::get('admin/dashboard/produtos/api/doc', 'App\Http\Controllers\ProdutoController@apiDoc')->name('doc');;
    Route::get('admin/dashboard/produto/cupons','App\Http\Controllers\ProdutoController@cuponsLista')->name('cupons-lista');
    Route::get('admin/dashboard/produto/cupons/create','App\Http\Controllers\ProdutoController@cuponsCreate')->name('cupons-create');
    Route::post('admin/dashboard/produto/cupons/create','App\Http\Controllers\ProdutoController@cupomStore')->name('cupom-store');
    Route::get('admin/dashboard/produto/cupons/{$produto_id}','App\Http\Controllers\ProdutoController@cupons')->name('cupons');
    Route::resource('admin/dashboard/clientes', 'App\Http\Controllers\ClientesDashboardController',["as"=>"interno"]);
    Route::resource('admin/dashboard/pedidos', 'App\Http\Controllers\PedidosDashboardController',["as"=>"pedidos"]);
});



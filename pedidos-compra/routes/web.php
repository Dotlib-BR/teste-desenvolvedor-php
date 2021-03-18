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

Route::get('/', function () {
    return view('principal');
});

Route::get('/', 'App\Http\Controllers\SiteController@paginaInicial')->name('principal');

Route::get('efetuar.logout', 'App\Http\Controllers\SiteController@efetuarLogout')->name('efetuar.logout');


Route::get('pagina.login', 'App\Http\Controllers\SiteController@paginaLogin')->name('pagina.login');

Route::get('pagina.cadastro', 'App\Http\Controllers\SiteController@paginaCadastro')->name('pagina.cadastro');

Route::post('efetuar.cadastro.usuario','App\Http\Controllers\CreateController@efetuarCadastroUsuario')->name('efetuar.cadastro.usuario');

Route::post('efetuar.login.usuario','App\Http\Controllers\SiteController@efetuarLoginUsuario')->name('efetuar.login.usuario');

/*Clientes*/

Route::get('lista.clientes', 'App\Http\Controllers\SiteController@listaClientes')->name('lista.clientes');

Route::get('lista.clientes', 'App\Http\Controllers\SiteController@listaClientesOrderBy')->name('lista.clientes');

Route::get('lista.clientes.paginate', 'App\Http\Controllers\SiteController@listaClientesPaginate')->name('lista.clientes.paginate');


Route::get('cadastro.cliente','App\Http\Controllers\SiteController@cadastroCliente')->name('cadastro.cliente');

Route::post('create.cliente','App\Http\Controllers\CreateController@createCliente')->name('create.cliente');

Route::delete('delete.cliente/{id}','App\Http\Controllers\DeleteController@deleteCliente')->name('delete.cliente');

Route::post('salvar.cliente.editado/{id}','App\Http\Controllers\EditController@salvarClienteEditado')->name('salvar.cliente.editado');

Route::post('deletar.clientes.selecionados','App\Http\Controllers\DeleteController@deletarClientesSelecionados')->name('deletar.clientes.selecionados');

Route::get('editar.cliente/{id}','App\Http\Controllers\EditController@editarCliente')->name('editar.cliente');


/*Produtos*/

Route::get('lista.produtos', 'App\Http\Controllers\SiteController@listaProdutos')->name('lista.produtos');

Route::get('lista.produtos', 'App\Http\Controllers\SiteController@listaProdutosOrderBy')->name('lista.produtos');

Route::get('lista.produtos.paginate', 'App\Http\Controllers\SiteController@listaProdutosPaginate')->name('lista.produtos.paginate');


Route::get('cadastro.produto','App\Http\Controllers\SiteController@cadastroProduto')->name('cadastro.produto');

Route::post('create.produto','App\Http\Controllers\CreateController@createProduto')->name('create.produto');

Route::delete('delete.produto/{id}','App\Http\Controllers\DeleteController@deleteProduto')->name('delete.produto');

Route::post('salvar.produto.editado/{id}','App\Http\Controllers\EditController@salvarProdutoEditado')->name('salvar.produto.editado');

Route::post('deletar.produtos.selecionados','App\Http\Controllers\DeleteController@deletarProdutosSelecionados')->name('deletar.produtos.selecionados');

Route::get('editar.produto/{id}','App\Http\Controllers\EditController@editarProduto')->name('editar.produto');


/*Pedidos*/

Route::get('lista.pedidos', 'App\Http\Controllers\SiteController@listaPedidos')->name('lista.pedidos');

Route::get('lista.pedidos', 'App\Http\Controllers\SiteController@listaPedidosOrderBy')->name('lista.pedidos');

Route::get('lista.pedidos.paginate', 'App\Http\Controllers\SiteController@listaPedidosPaginate')->name('lista.pedidos.paginate');


Route::get('cadastro.pedido','App\Http\Controllers\SiteController@cadastroPedidoCompra')->name('cadastro.pedido');

Route::post('create.pedido','App\Http\Controllers\CreateController@createPedido')->name('create.pedido');

Route::delete('delete.pedido/{id}','App\Http\Controllers\DeleteController@deletePedido')->name('delete.pedido');

Route::post('alterar.status.pedido/{id}','App\Http\Controllers\EditController@alterarStatusPedido')->name('alterar.status.pedido');

Route::post('salvar.pedido.editado/{id}','App\Http\Controllers\EditController@salvarPedidoEditado')->name('salvar.pedido.editado');

Route::post('deletar.pedidos.selecionados','App\Http\Controllers\DeleteController@deletarPedidosSelecionados')->name('deletar.pedidos.selecionados');

Route::get('editar.pedido/{id}','App\Http\Controllers\EditController@editarPedido')->name('editar.pedido');



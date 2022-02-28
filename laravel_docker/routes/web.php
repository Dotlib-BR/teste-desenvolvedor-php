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

use App\Http\Controllers\{SemAutenticacao, ComAutenticacao};
use App\Models\{Categorias, Cadastros, Pedidos, Produtos};


// Páginas Sem Autenticação
    // Index
    Route::redirect('/index', '/', 302);
    Route::get('/', [SemAutenticacao::class, 'index'])->name('pagina-inicial');
    Route::post('/', [ComAutenticacao::class, 'adicionarCarrinho']);


    Route::get('/login', [SemAutenticacao::class, 'loginGet'])->name('pagina-login');
    Route::post('/login', [SemAutenticacao::class, 'loginPost']);


    Route::get('/cadastro', [SemAutenticacao::class, 'cadastroGet'])->name('pagina-cadastro');
    Route::post('/cadastro', [SemAutenticacao::class, 'cadastroPost']);

    Route::get('/logout', [SemAutenticacao::class, 'logout'])->name('pagina-logout');

    Route::get('/area-chernobyl', [SemAutenticacao::class, 'teste']);

// Páginas Com Autenticação
    // Geral
    Route::get('/meu-perfil', [ComAutenticacao::class, 'meuPerfil'])->name('perfil');



    // Clientes
    Route::get('/carrinho', [ComAutenticacao::class, 'carrinhoGet']);
    Route::post('/carrinho', [ComAutenticacao::class, 'carrinhoPost']);
    Route::post('/carrinho/{param1}', [ComAutenticacao::class, 'carrinhoDelete']);


    Route::redirect('/meus-pedidos', '/meus-pedidos/abertos', 302);
    Route::get('/meus-pedidos/abertos', [ComAutenticacao::class, 'meusPedidosAbertos'])->name('pedidos-abertos');


    Route::get('/meus-pedidos/pagos', [ComAutenticacao::class, 'meusPedidosPagos'])->name('pedidos-pagos');


    Route::get('/meus-pedidos/cancelados', [ComAutenticacao::class, 'meusPedidosCancelados'])->name('pedidos-cancelados');


    Route::get('/meus-pedidos/{param1}', [ComAutenticacao::class, 'meusPedidosDetalhados']);



    // Administrativos
    Route::redirect('/admin', '/admin/cadastros');

    Route::get('/admin/cadastros', [ComAutenticacao::class, 'adminCadastros'])->name('admin-cadastros');
    Route::post('/admin/cadastros', [ComAutenticacao::class, 'adminCadastrosPost']);
    Route::get('/admin/cadastros/{param1}', [ComAutenticacao::class, 'adminCadastrosDelete']);
    
    
    Route::get('/admin/produtos', [ComAutenticacao::class, 'adminProdutos']);
    Route::post('/admin/produtos', [ComAutenticacao::class, 'adminProdutosPost']);
    Route::get('/admin/produtos/{param1}', [ComAutenticacao::class, 'adminProdutosDelete']);


    Route::get('/admin/categorias', [ComAutenticacao::class, 'adminCategorias']);
    Route::post('/admin/categorias', [ComAutenticacao::class, 'adminCategoriasPost']);
    Route::get('/admin/categorias/{param1}', [ComAutenticacao::class, 'adminCategoriasDelete']);
    
    
    Route::get('/admin/pedidos', [ComAutenticacao::class, 'adminPedidos']);
    Route::post('/admin/pedidos', [ComAutenticacao::class, 'adminPedidosPost']);
    Route::get('/admin/pedidos/{param1}', [ComAutenticacao::class, 'adminPedidosDetalhados']);


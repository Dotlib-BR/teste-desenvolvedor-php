<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Controle\{
    ClienteController,
    CupomDescontoController,
    DashboardController,
    PedidoController,
    ProdutoController,
};

Route::prefix('controle')
    ->name('controle.')
    ->middleware(['auth'])
    ->group(function () {
        Route::get('', [DashboardController::class, 'index'])->name('dashboard');

        Route::get('produtos', [ProdutoController::class, 'index'])->name('produtos.index');
        Route::get('produtos/create', [ProdutoController::class, 'create'])->name('produtos.create');
        Route::post('produtos/store', [ProdutoController::class, 'store'])->name('produtos.store');
        Route::put('produtos/update/{id}', [ProdutoController::class, 'update'])->name('produtos.update');
        Route::get('produtos/edit/{id}', [ProdutoController::class, 'edit'])->name('produtos.edit');
        Route::delete('produtos/destroy/{id}', [ProdutoController::class, 'destroy'])->name('produtos.destroy');

        Route::get('clientes', [ClienteController::class, 'index'])->name('clientes.index');
        Route::get('clientes/create', [ClienteController::class, 'create'])->name('clientes.create');
        Route::post('clientes/store', [ClienteController::class, 'store'])->name('clientes.store');
        Route::put('clientes/update/{id}', [ClienteController::class, 'update'])->name('clientes.update');
        Route::get('clientes/edit/{id}', [ClienteController::class, 'edit'])->name('clientes.edit');
        Route::delete('clientes/destroy/{id}', [ClienteController::class, 'destroy'])->name('clientes.destroy');

        Route::get('cupom', [CupomDescontoController::class, 'index'])->name('cupom.index');
        Route::get('cupom/create', [CupomDescontoController::class, 'create'])->name('cupom.create');
        Route::post('cupom/store', [CupomDescontoController::class, 'store'])->name('cupom.store');
        Route::put('cupom/update/{id}', [CupomDescontoController::class, 'update'])->name('cupom.update');
        Route::get('cupom/edit/{id}', [CupomDescontoController::class, 'edit'])->name('cupom.edit');
        Route::delete('cupom/destroy/{id}', [CupomDescontoController::class, 'destroy'])->name('cupom.destroy');

        Route::get('pedidos', [PedidoController::class, 'index'])->name('pedidos.index');
        Route::get('pedido/create', [PedidoController::class, 'create'])->name('pedidos.create');
        Route::get('pedido/show/{id}', [PedidoController::class, 'show'])->name('pedidos.show');
        Route::post('pedido/store', [PedidoController::class, 'store'])->name('pedidos.store');
        Route::put('pedido/update/{id}', [PedidoController::class, 'update'])->name('pedidos.update');
        Route::get('pedido/edit/{id}', [PedidoController::class, 'edit'])->name('pedidos.edit');
        Route::delete('pedido/destroy/{id}', [PedidoController::class, 'destroy'])->name('pedidos.destroy');
});


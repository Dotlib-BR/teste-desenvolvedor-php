<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Rotas da API Rest JSON
|--------------------------------------------------------------------------
|
| Aqui é onde você pode registrar rotas de API para seu aplicativo.
| Essas rotas são carregadas pelo RouteServiceProvider dentro de um grupo que
| é atribuído o grupo de middleware "zeus".
|
*/

Route::namespace('Zeus')
    ->group(function () {

        Route::apiResource('clients', 'ClientController');// CRUD de clientes
        Route::apiResource('purchases', 'PurchaseController');// CRUD de pedidos de compra
        Route::apiResource('products', 'ProductController');// CRUD de produtos

        Route::post('bulk-action/destroy', 'BulkActionController@destroy')
            ->name('bulk_action.destroy');// Excluir usuários em massa
    });

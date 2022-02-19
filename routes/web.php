<?php

use App\Http\Controllers\Web;
use Illuminate\Support\Facades\Route;

Route::get('/', [Web::class, 'home'])->name('web.home');

Route::get('/clientes', [Web::class, 'clients'])->name('web.clients');
Route::get('/produtos', [Web::class, 'products'])->name('web.products');
Route::get('/pedidos', [Web::class, 'orders'])->name('web.orders');
Route::get('/clientes/{filter}', [Web::class, 'filterClients'])->name('web.filterClients');
Route::get('/produtos/{filter}', [Web::class, 'filterProducts'])->name('web.filterProducts');
Route::get('/pedidos/{filter}', [Web::class, 'filterOrders'])->name('web.filterOrders');
Route::get('/novo/{table}', [Web::class, 'create'])->name('web.create');
Route::get('/editar/{table}/{id}', [Web::class, 'edit'])->name('web.edit');
Route::get('/view/{table}/{id}', [Web::class, 'view'])->name('web.view');


Route::get('/teste/{nome}', [Web::class, 'teste'])->name('web.teste');

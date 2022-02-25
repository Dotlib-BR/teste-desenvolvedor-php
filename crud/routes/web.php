<?php

use App\Http\Controllers\{
    CustomersController,
    ProductsController,
    RequestsController
};
use Illuminate\Support\Facades\Route;

Route::controller(CustomersController::class)
->name('customers.')// ->prefix('customers')
->group(function(){

    Route::get('/customers', 'index')->name('index');
    Route::get('/add', 'add')->name('add');
    Route::post('/add','insert')->name('insert');
    Route::get('/edit/{id}', 'edit')->name('edit');

    Route::get('/customers/{id}', 'show');
});








Route::get('/products', [ProductsController::class, 'index'])
    ->name('products.index');

Route::get('/requests', [RequestsController::class, 'index'])
    ->name('requests.index');

Route::get('/', function () {
    return view('home');
});

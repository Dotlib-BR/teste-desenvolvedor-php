<?php

use App\Http\Controllers\{
    CustomersController,
    ProductsController,
    RequestsController
};
use Illuminate\Support\Facades\Route;

Route::controller(CustomersController::class)
->name('customers.')
->prefix('customers')
->group(function(){
    Route::get('/', 'index')->name('index');
    Route::get('/add', 'add')->name('create');
    Route::post('/add','insert')->name('store');
    Route::get('/edit/{id}', 'edit')->name('edit');
    Route::put('/update/{id}', 'saveEdit')->name('save');
    Route::delete('/delet/{id}', 'delet')->name('destroy');

});

Route::controller(ProductsController::class)
->name('products.')
->prefix('products')
->group(function(){
    Route::get('/', 'index')->name('index');
    Route::get('/add', 'add')->name('create');
    Route::post('/add','insert')->name('store');
    Route::get('/edit/{id}', 'edit')->name('edit');
    Route::put('/update/{id}', 'saveEdit')->name('save');
    Route::delete('/delet/{id}', 'delet')->name('destroy');
    
});

Route::controller(RequestsController::class)
->name('requests.')
->prefix('requests')
->group(function(){
    Route::get('/', 'index')->name('index');
    Route::get('/add', 'add')->name('create');
    Route::post('/add','insert')->name('store');
    Route::get('/type', 'addType')->name('create');
    Route::post('/type','insertType')->name('store');


    
});


Route::get('/', function () {
    return view('home');
});

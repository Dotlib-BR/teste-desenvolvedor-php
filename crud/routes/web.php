<?php

use App\Http\Controllers\{
    UserController,
    ProductsController,
    RequestsController
};
use Illuminate\Support\Facades\Route;

Route::get('/users', [UserController::class, 'index'])
    ->name('user.index');

Route::get('/users/{id}', [UserController::class, 'show'])
    ->name('user.show');

Route::get('/products', [ProductsController::class, 'index'])
    ->name('products.index');

Route::get('/requests', [RequestsController::class, 'index'])
    ->name('requests.index');

Route::get('/', function () {
    return view('home');
});

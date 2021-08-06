<?php

use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\ClienteController;
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

Route::get('/',[ClienteController::class, 'index'])->name('cliente.index');


Route::group([
    'prefix' => 'cliente'
], function () {
    Route::get('/edit/{id}',[ClienteController::class, 'edit'])->name('cliente.edit');
    Route::put('/edit/{id}',[ClienteController::class, 'update'])->name('cliente.update');
    Route::get('/create',[ClienteController::class, 'create'])->name('cliente.create');
    Route::post('/store',[ClienteController::class, 'store'])->name('cliente.store');
    Route::delete('/delete/{id}',[ClienteController::class, 'destroy'])->name('cliente.delete');
});

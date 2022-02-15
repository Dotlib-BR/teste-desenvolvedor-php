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
    return view('home');
})->name('home');


Route::get('/client', [\App\Http\Controllers\ClienteController::class, 'getClient'])->name("client.get.list");

Route::get('/client/create', [\App\Http\Controllers\ClienteController::class, 'getClientCreate'])->name("client.get.create");
Route::post('/client/create', [\App\Http\Controllers\ClienteController::class, 'postClientCreate'])->name("client.post.create");

Route::get('/client/edit/{id}', [\App\Http\Controllers\ClienteController::class, 'getClientEdit'])->name("client.get.edit");
Route::put('/client/edit/{id}', [\App\Http\Controllers\ClienteController::class, 'putClientEdit'])->name("client.put.edit");


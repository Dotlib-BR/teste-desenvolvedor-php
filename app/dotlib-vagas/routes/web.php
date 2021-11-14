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

Route::get('/', 'App\Http\Controllers\HomeController@index');


/** Vagas */
Route::resource('/vagas', 'App\Http\Controllers\VagasController');
Route::post('/pesquisar', 'App\Http\Controllers\VagasController@pesquisar');
Route::get('/pesquisar/{order?}', 'App\Http\Controllers\VagasController@index');

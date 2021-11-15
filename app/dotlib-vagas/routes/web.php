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

/** Auth */
Route::get('/', 'App\Http\Controllers\AuthController@index')->name('login');
Route::post('/auth/login', 'App\Http\Controllers\AuthController@login');
Route::post('/auth/store', 'App\Http\Controllers\AuthController@store');
Route::get('/auth/logout', 'App\Http\Controllers\AuthController@logout');
Route::get('/auth/register', 'App\Http\Controllers\AuthController@register');

Route::middleware(['auth:web'])->group(function(){
    /** Vagas */
    Route::resource('/vagas', 'App\Http\Controllers\VagasController');
    Route::get('/vagas/pausar/{id}', 'App\Http\Controllers\VagasController@pausarVaga');
    Route::post('/vagas/pesquisar', 'App\Http\Controllers\VagasController@pesquisar');
    Route::get('/vagas/pesquisar/{order?}', 'App\Http\Controllers\VagasController@index');

    /** Users */
    Route::resource('/users', 'App\Http\Controllers\UsersController');
    Route::post('/users/pesquisar', 'App\Http\Controllers\UsersController@pesquisar');
    Route::get('/users/pesquisar/{order?}', 'App\Http\Controllers\UsersController@index');

    /** Inscricoes */
    Route::post('/inscricoes/pesquisar', 'App\Http\Controllers\InscricoesController@pesquisar');
    Route::get('/inscricoes/pesquisar/{order?}', 'App\Http\Controllers\InscricoesController@index');
    Route::get('/inscricoes/{id}', 'App\Http\Controllers\InscricoesController@inscricaoUserVaga');
});


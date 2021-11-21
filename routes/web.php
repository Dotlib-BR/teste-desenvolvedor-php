<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Sistema\SiteController;
use App\Http\Controllers\Sistema\UserController;
use App\Http\Controllers\Sistema\AnuncioController;
use App\Http\Controllers\Sistema\DashboardController;
use App\Http\Controllers\Sistema\VagasVinculoController;


Route::get('/',[SiteController::class, 'index']);
Route::get('/login',[UserController::class, 'login'])->name('login');
Route::post('/logar',[UserController::class, 'login_action'])->name('login_action');

Route::middleware(['checked','active'])->prefix('/sistema')->group(function () {
    Route::get('/dashboard',[DashboardController::class, 'index'])->name('dashboard');
    Route::get('/usuario/{id}',[UserController::class, 'isMe'])->name('usuario.isMe');
    Route::put('/usuario/{id}',[UserController::class, 'updateIsMe'])->name('usuario.updateIsMe');
    Route::post('/logout',[UserController::class, 'logout'])->name('logout');
    Route::get('/anuncios_list',[VagasVinculoController::class, 'anunciosList'])->name('anuncios.list');
    Route::get('/anuncios_check/{id}',[VagasVinculoController::class, 'anunciosChecked'])->name('anuncios.check');
    Route::post('/anuncios_check',[VagasVinculoController::class, 'anunciosCandidadoVinculo'])->name('anuncios.vagavinculo');

});


Route::middleware(['checked', 'active', 'admin'])->prefix('/sistema')->group(function () {
    //ANUNCIOS * VAGAS *
    Route::get('/anuncios',[AnuncioController::class, 'index'])->name('anuncios');
    Route::get('/anuncio',[AnuncioController::class, 'create'])->name('anuncio.create');
    Route::post('/anuncio',[AnuncioController::class, 'store'])->name('anuncio.store');
    Route::get('/anuncio/{id}',[AnuncioController::class, 'edit'])->name('anuncio.edit');
    Route::put('/anuncio/{id}',[AnuncioController::class, 'update'])->name('anuncio.update');
    Route::delete('/anuncio/{id}',[AnuncioController::class, 'destroy'])->name('anuncio.delete');
    /** CANDIDATOS (USUARIOS DO SISTEMA) */
    Route::get('/register',[UserController::class, 'create'])->name('usuario.create');
    Route::post('/register',[UserController::class, 'store'])->name('usuario.store');
    Route::get('/edit/{id}',[UserController::class, 'edit'])->name('usuarios.edit');
    Route::put('/edit/{id}',[UserController::class, 'update'])->name('usuario.update');
    Route::delete('/usuario/{id}',[UserController::class, 'destroy'])->name('usuario.delete');
    Route::get('/users',[UserController::class, 'index'])->name('usuarios');
});

Route::middleware(['checked', 'active', 'admin', 'user'])->prefix('/sistema')->group(function () {

});



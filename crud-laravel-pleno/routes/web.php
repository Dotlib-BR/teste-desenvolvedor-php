<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VagaController;
use App\Http\Controllers\InscricaoController;
use App\Http\Controllers\CandidatoController;
use App\Http\Controllers\AuthController;


Route::get('login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('login', [AuthController::class, 'login']);
Route::post('logout', [AuthController::class, 'logout'])->name('logout');


Route::prefix('vagas')->group(function () {
    Route::get('/', [VagaController::class, 'index']);
    Route::post('/', [VagaController::class, 'store']);
    Route::get('/{vaga}', [VagaController::class, 'show']);
    Route::put('/{vaga}', [VagaController::class, 'update']);
    Route::delete('/{vaga}', [VagaController::class, 'destroy']);
});

Route::prefix('users')->group(function () {
    Route::get('/', [UserController::class, 'index']);
    Route::post('/', [UserController::class, 'store']);
    Route::get('/{user}', [UserController::class, 'show']);
    Route::put('/{user}', [UserController::class, 'update']);
    Route::delete('/{user}', [UserController::class, 'destroy']);
});

Route::prefix('inscricoes')->group(function () {
    Route::get('/', [InscricaoController::class, 'index']);
    Route::post('/', [InscricaoController::class, 'store']);
    Route::get('/{inscricao}', [InscricaoController::class, 'show']);
    Route::put('/{inscricao}', [InscricaoController::class, 'update']);
    Route::delete('/{inscricao}', [InscricaoController::class, 'destroy']);
});

Route::prefix('candidatos')->group(function () {
    Route::get('/', [CandidatoController::class, 'index']);
    Route::post('/', [CandidatoController::class, 'store']);
    Route::get('/{candidato}', [CandidatoController::class, 'show']);
    Route::put('/{candidato}', [CandidatoController::class, 'update']);
    Route::delete('/{candidato}', [CandidatoController::class, 'destroy']);
});

Route::get('/', function () {
    return view('welcome');
});

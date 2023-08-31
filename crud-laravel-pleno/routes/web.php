<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\VagaController;
use App\Http\Controllers\CandidatoController;
use App\Http\Controllers\InscricaoController;
use App\Http\Controllers\AuthController;

// Rotas públicas

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');

// Rotas protegidas por autenticação
Route::middleware(['auth'])->group(function () {
    // Rotas de vagas
    Route::prefix('vagas')->group(function () {
        Route::get('/', [VagaController::class, 'index']);
        Route::post('/', [VagaController::class, 'store']);
        Route::get('/{vaga}', [VagaController::class, 'show']);
        Route::put('/{vaga}', [VagaController::class, 'update']);
        Route::delete('/{vaga}', [VagaController::class, 'destroy']);
    });

    // Rotas de candidatos
    Route::prefix('candidatos')->group(function () {
        Route::get('/', [CandidatoController::class, 'index']);
        Route::post('/', [CandidatoController::class, 'store']);
        Route::get('/{candidato}', [CandidatoController::class, 'show']);
        Route::put('/{candidato}', [CandidatoController::class, 'update']);
        Route::delete('/{candidato}', [CandidatoController::class, 'destroy']);
    });

    // Rotas de inscrições
    Route::prefix('inscricoes')->group(function () {
        Route::get('/', [InscricaoController::class, 'index']);
        Route::post('/', [InscricaoController::class, 'store']);
        Route::get('/{inscricao}', [InscricaoController::class, 'show']);
        Route::put('/{inscricao}', [InscricaoController::class, 'update']);
        Route::delete('/{inscricao}', [InscricaoController::class, 'destroy']);
    });

    // Restante das rotas protegidas
});

// Rotas API
    Route::prefix('api')->group(function () {
        Route::apiResource('vagas', VagaController::class);
        Route::apiResource('candidatos', CandidatoController::class);
        Route::apiResource('inscricoes', InscricaoController::class);
        Route::post('login', [AuthController::class, 'login']); // Rota de login para a API
    });

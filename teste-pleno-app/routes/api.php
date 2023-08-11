<?php

use Illuminate\Http\Request;
use App\Http\Controllers\VagaController;
use App\Http\Controllers\CandidatoController;

// Rotas da API para Vagas
Route::prefix('vagas')->group(function () {
    Route::get('/', [VagaController::class, 'index']);
    Route::get('/{vaga}', [VagaController::class, 'show']);
    Route::post('/', [VagaController::class, 'store']);
    Route::put('/{vaga}', [VagaController::class, 'update']);
    Route::delete('/{vaga}', [VagaController::class, 'destroy']);
});

// Rotas da API para Candidatos
Route::prefix('candidatos')->group(function () {
    Route::get('/', [CandidatoController::class, 'index']);
    Route::get('/{candidato}', [CandidatoController::class, 'show']);
    Route::post('/', [CandidatoController::class, 'store']);
    Route::put('/{candidato}', [CandidatoController::class, 'update']);
    Route::delete('/{candidato}', [CandidatoController::class, 'destroy']);
});


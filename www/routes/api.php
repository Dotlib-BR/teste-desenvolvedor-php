<?php

use Illuminate\Support\Facades\Route;

Route::prefix('v1')->group(function(){

    Route::prefix('auth')->group(function(){

        Route::post('login', [App\Http\Controllers\Api\Auth\JWTLoginController::class, 'login']);
        Route::get('logout', [App\Http\Controllers\Api\Auth\JWTLoginController::class, 'logout']);
        Route::get('refresh', [App\Http\Controllers\Api\Auth\JWTLoginController::class, 'refresh']);
        Route::get('me', [App\Http\Controllers\Api\Auth\JWTLoginController::class, 'me']);
        Route::get('user', [App\Http\Controllers\Api\Auth\JWTLoginController::class, 'user']);
    });

    Route::group(['middleware' => ['UserAPIPermission']], function () {

        Route::prefix('empresa')->group(function(){
            Route::resource('vagas', App\Http\Controllers\Api\Empresa\VagasController::class);
            Route::patch('vagas/{id}/pause', [App\Http\Controllers\Api\Empresa\VagasController::class, 'pause']);
        });

        Route::prefix('candidato')->group(function(){
            Route::get('minhas-inscricoes', [App\Http\Controllers\Api\Candidato\InscricoesController::class, 'inscricoes']);
            Route::get('minhas-inscricoes/vaga/{id}/cancelar', [App\Http\Controllers\Api\Candidato\InscricoesController::class, 'cancelar']);
            Route::post('/vaga/{id}/inscrever', [App\Http\Controllers\Api\Candidato\InscricoesController::class, 'inscrever']);
        });
    });
});


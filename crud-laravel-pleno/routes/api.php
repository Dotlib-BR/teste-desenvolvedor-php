<?php 

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\VagaController;
use App\Http\Controllers\CandidatoController;
use App\Http\Controllers\InscricaoController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;

// Rotas de vagas (CRUD)
Route::apiResource('vagas', VagaController::class);

// Rotas de candidatos (CRUD)
Route::apiResource('candidatos', CandidatoController::class);

// Rotas de inscrições (CRUD)
Route::apiResource('inscricoes', InscricaoController::class);

// Rotas de autenticação
Route::post('login', [AuthController::class, 'login']);
Route::post('logout', [AuthController::class, 'logout'])->middleware('auth:api');

// Rotas de usuário (CRUD)
Route::apiResource('users', UserController::class)->middleware('auth:api');

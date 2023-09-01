<?php 

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VagaController;
use App\Http\Controllers\InscricaoController;
use App\Http\Controllers\CandidatoController;
use App\Http\Controllers\AuthController;

Route::get('/welcome', function () {
    return view('welcome');
});

// Rota de login
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

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
    Route::prefix('inscricaos')->group(function () {
        Route::get('/', [InscricaoController::class, 'index']);
        Route::post('/', [InscricaoController::class, 'store']);
        Route::get('/{inscricao}', [InscricaoController::class, 'show']);
        Route::put('/{inscricao}', [InscricaoController::class, 'update']);
        Route::delete('/{inscricao}', [InscricaoController::class, 'destroy']);
    });

    // Rota de logout
    Route::post('/logout', [AuthController::class, 'logout']);
});

// Rotas API
Route::prefix('api')->group(function () {
    Route::apiResource('vagas', VagaController::class);
    Route::apiResource('candidatos', CandidatoController::class);
    Route::apiResource('inscricaos', InscricaoController::class);
    Route::apiResource('users', UserController::class);
});

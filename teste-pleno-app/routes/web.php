<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\VagaController;
use App\Http\Controllers\CandidatoController;
use App\Http\Controllers\Auth\CandidatoAuthenticatedSessionController;

// Rota da página inicial
Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::middleware(['auth'])->group(function () {
    // Rotas para Vagas
    Route::resource('vagas', VagaController::class);
    Route::get('/vagas/candidatos', [CandidatoController::class, 'index'])->name('candidatos.index');
    Route::get('/vagas/{vaga}', [VagaController::class, 'show'])->name('vagas.show');
    Route::delete('/vagas/{vaga}/candidatos/{candidato}', [CandidatoController::class, 'destroy'])->name('candidatos.destroy');




    // Rotas para Candidato
    Route::get('/vagas/candidatos/candidatar/{vaga}', [CandidatoController::class, 'candidatarForm'])->name('candidatar-form');
    Route::post('/vagas/candidatos/candidatar/{vaga}', [CandidatoController::class, 'candidatar'])->name('salvar-candidatura');
});



Route::get('/listar-vagas',  [VagaController::class, 'candidatarse'])->name('listar-vagas');
Route::get('/candidatar-vaga/{vaga}', [VagaController::class, 'detalhesVaga'])->name('candidatar-vaga');
Route::post('/candidatar-vaga/{vaga}', [CandidatoController::class, 'candidatar'])->name('candidatar-vaga');
Route::delete('/remover-candidatura/{vaga}', [CandidatoController::class, 'removerCandidatura'])->name('remover-candidatura');
Route::get('/vagas-candidato', [CandidatoController::class, 'vagasCandidato'])->name('vagas-candidato');




Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

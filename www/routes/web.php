<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Dashboard\Empresa\VagaController;

Route::namespace('Auth')->name('auth.')->group(function(){
    Route::get('/login', [App\Http\Controllers\Auth\LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [App\Http\Controllers\Auth\LoginController::class, 'login'])->name('login.submit');
    Route::get('/logout', [App\Http\Controllers\Auth\LoginController::class, 'logout'])->name('logout');
    Route::get('/empresa/registro', [ App\Http\Controllers\Auth\RegisterController::class, 'formEmpresa'])->name('empresa.registro');
    Route::post('/empresa/registro', [ App\Http\Controllers\Auth\RegisterController::class, 'registroEmpresa'])->name('empresa.registro.submit');
    Route::get('/candidato/registro', [App\Http\Controllers\Auth\RegisterController::class, 'formCandidato'])->name('candidato.registro');
    Route::post('/candidato/registro', [ App\Http\Controllers\Auth\RegisterController::class, 'registroCandidato'])->name('candidato.registro.submit');
});

Route::namespace('Site')->name('site.')->group(function(){
    Route::get('/', [\App\Http\Controllers\Site\SiteController::class, 'lista'])->name('home');
    Route::get('/vaga/{slug}', [\App\Http\Controllers\Site\SiteController::class, 'vaga'])->name('vaga');
    Route::post('/vaga/{slug}/inscrever', [App\Http\Controllers\Site\SiteController::class, 'inscrever'])->name('vaga.inscrever');

    Route::get('users', [App\Http\Controllers\Site\SiteController::class, 'users'])->name('users');
});

Route::name('dashboard.')->middleware('checkUser')->group(function(){

    Route::prefix('empresa')->name('empresa.')->group(function(){
        Route::get('home', [App\Http\Controllers\Dashboard\Empresa\HomeController::class, 'home'])->name('home');

        Route::prefix('perfil')->group(function(){
            Route::get('/', [App\Http\Controllers\Dashboard\Empresa\HomeController::class, 'perfil'])->name('perfil');
            Route::delete('{user_id}/delete',  [App\Http\Controllers\Dashboard\Empresa\HomeController::class, 'apagarConta'])->name('perfil.delete');
            Route::patch('{user_id}/update', [App\Http\Controllers\Dashboard\Empresa\HomeController::class, 'perfilUpdate'])->name('perfil.update');

        });

        Route::delete('vagas/mass-delete', [VagaController::class, 'massDelete'])->name('vagas.mass-delete');
        Route::resource('vagas', VagaController::class);

        Route::get('vagas/{slug}/pause', [VagaController::class, 'pause'])->name('vaga.pause');

        Route::prefix('ajax')->group(function(){
            Route::get('tags', [VagaController::class, 'tags'])->name('tags.json');
        });
    });

    Route::prefix('candidato')->name('candidato.')->group(function(){
        Route::get('home', [App\Http\Controllers\Dashboard\Candidato\HomeController::class, 'home'])->name('home');

        Route::prefix('perfil')->group(function(){
            Route::get('/', [App\Http\Controllers\Dashboard\Candidato\HomeController::class, 'perfil'])->name('perfil');

            Route::delete('{user_id}/delete', [App\Http\Controllers\Dashboard\Candidato\HomeController::class, 'apagarConta'])->name('perfil.delete');
            Route::patch('{user_id}/update', [App\Http\Controllers\Dashboard\Candidato\HomeController::class, 'perfilUpdate'])->name('perfil.update');
        });

        Route::get('minhas-inscricoes', [App\Http\Controllers\Dashboard\Candidato\InscricoesController::class, 'inscricoes'])->name('inscricoes');

        Route::get('minhas-inscricoes/vaga/{slug}/cancelar', [App\Http\Controllers\Dashboard\Candidato\InscricoesController::class, 'cancelar'])->name('inscricao.cancelar');

    });

});

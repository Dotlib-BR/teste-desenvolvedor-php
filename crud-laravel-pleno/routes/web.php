<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return redirect()->route('vagas.index'); // Redirect to 'vagas.index' route
})->name('home');

// Rotas para CRUD de Vagas
Route::resource('vagas', VagaController::class);

// Rotas para CRUD de Candidatos
Route::resource('candidatos', CandidatoController::class);

// Rota para página de inscrição em vagas
Route::get('/vagas/inscricao', [VagaController::class, 'mostrarPaginaInscricao'])->name('vagas.inscricao');
Route::post('/vagas/inscrever/{vaga}', [InscricaoController::class, 'inscrever'])->name('vagas.inscrever');

// ...

Route::middleware(['auth', 'verified'])->group(function () {
    // Rotas que requerem autenticação e verificação de email
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    // Rotas de perfil
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VagaController;

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

Route::get('/', function () {
    return view('welcome');
});

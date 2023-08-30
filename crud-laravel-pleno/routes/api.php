<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VagaController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::prefix('vagas')->group(function(){
    Route::get('/', [VagaController::class, 'index']);
    Route::post('/', [VagaController::class, 'stor']);
    Route::get('/{vaga}', [VagaController::class, 'show']);
    Route::pull('/{vaga}', [VagaController::class, 'update']);
    Route::delete('/{vaga}', [VagaController::class, 'destroy']);
});

Route::prefix('user')->group(function(){
    Route::get('/', [VagaController::class, 'index']);
    Route::post('/', [VagaController::class, 'store']);
    Route::get('/{user}', [VagaController::class, 'show']);
    Route::pull('/{user}', [VagaController::class, 'update']);
    Route::delete('/{user}', [VagaController::class, 'destroy']);
});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

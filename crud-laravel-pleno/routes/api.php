<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\JobController as APIJobController;
use App\Http\Controllers\API\CandidateController as APICandidateController;
use App\Http\Controllers\API\ApplicationController as APIApplicationController;

Route::middleware(['auth:api'])->group(function () {
    // Rota de recursos para jobs com prefixo de nome 'api'
    Route::apiResource('jobs', APIJobController::class)->names([
        'index' => 'api.jobs.index',
        'store' => 'api.jobs.store',
        'show' => 'api.jobs.show',
        'update' => 'api.jobs.update',
        'destroy' => 'api.jobs.destroy',
    ]);

    // Rota de recursos para candidatos com prefixo de nome 'api'
    Route::apiResource('candidates', APICandidateController::class)->names([
        'index' => 'api.candidates.index',
        'store' => 'api.candidates.store',
        'show' => 'api.candidates.show',
        'update' => 'api.candidates.update',
        'destroy' => 'api.candidates.destroy',
    ]);

    // Rotas para Application
    Route::get('applications', [APIApplicationController::class, 'index']);
    Route::get('applications/{id}', [APIApplicationController::class, 'show']);
    Route::post('applications', [APIApplicationController::class, 'store']);
    Route::put('applications/{id}', [APIApplicationController::class, 'update']);
    Route::delete('applications/{id}', [APIApplicationController::class, 'destroy']);
});

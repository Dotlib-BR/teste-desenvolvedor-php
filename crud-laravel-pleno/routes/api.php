<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\JobController;
use App\Http\Controllers\ApplicationController;
use App\Http\Controllers\CandidateController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;

// Auth-protected Routes
Route::middleware(['auth'])->group(function () {

    // Job Routes
    Route::prefix('jobs')->group(function () {
        Route::get('/', [JobController::class, 'index']);
        Route::post('/', [JobController::class, 'store']);
        Route::get('/{job}', [JobController::class, 'show']);
        Route::put('/{job}', [JobController::class, 'update']);
        Route::delete('/{job}', [JobController::class, 'destroy']);
    });

    // Candidate Routes
    Route::prefix('candidates')->group(function () {
        Route::get('/', [CandidateController::class, 'index']);
        Route::post('/', [CandidateController::class, 'store']);
        Route::get('/{candidate}', [CandidateController::class, 'show']);
        Route::put('/{candidate}', [CandidateController::class, 'update']);
        Route::delete('/{candidate}', [CandidateController::class, 'destroy']);
    });

    // Application Routes
    Route::prefix('applications')->group(function () {
        Route::get('/', [ApplicationController::class, 'index']);
        Route::post('/', [ApplicationController::class, 'store']);
        Route::get('/{application}', [ApplicationController::class, 'show']);
        Route::put('/{application}', [ApplicationController::class, 'update']);
        Route::delete('/{application}', [ApplicationController::class, 'destroy']);
    });
});

// API Routes
Route::prefix('api')->group(function () {
    Route::post('login', [AuthController::class, 'login']); // API Login Route

    // Resource Routes for Job, Candidate, and Application
    Route::apiResource('jobs', JobController::class);
    Route::apiResource('candidates', CandidateController::class);
    Route::apiResource('applications', ApplicationController::class);

    // Dashboard Routes
    Route::get('dashboard', [DashboardController::class, 'index'])->middleware('auth:api');
});

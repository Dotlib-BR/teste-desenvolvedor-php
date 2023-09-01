<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\JobController;
use App\Http\Controllers\ApplicationController;
use App\Http\Controllers\CandidateController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;

Route::get('/', function () {
    return view('home');
})->withoutMiddleware(['auth']);

// Auth-protected Routes
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Login and Logout Routes
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    // Resource Routes for Job, Candidate, and Application
    Route::resource('jobs', JobController::class);
    Route::resource('candidates', CandidateController::class);
    Route::resource('applications', ApplicationController::class);
});

// API Routes
Route::prefix('api')->group(function () {
    Route::apiResource('jobs', JobController::class);
    Route::apiResource('candidates', CandidateController::class);
    Route::apiResource('applications', ApplicationController::class);
    // Add API routes for users if needed
});

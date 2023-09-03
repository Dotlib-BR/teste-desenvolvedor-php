<?php

use Illuminate\Support\Facades\Route;

Route::middleware([Authenticate::class])->group(function () {
    Route::apiResource('jobs', APIJobController::class);
    Route::apiResource('candidates', APICandidateController::class);
});

// Vagas
Route::apiResource('api/jobs', 'Api\JobController');

// Candidatos
Route::apiResource('api/candidates', 'Api\CandidateController');

// Aplicações
Route::get('api/applications', 'Api\ApplicationController@index');
Route::get('api/applications/{id}', 'Api\ApplicationController@show');
Route::post('api/applications', 'Api\ApplicationController@store');
Route::put('api/applications/{id}', 'Api\ApplicationController@update');
Route::delete('api/applications/{id}', 'Api\ApplicationController@destroy');

use App\Http\Controllers\API\JobController as APIJobController;
use App\Http\Controllers\API\CandidateController as APICandidateController;



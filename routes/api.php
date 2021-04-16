<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::apiResource('v1/produtos','App\Http\Controllers\ProdutosApi');

Route::middleware('auth:sanctum')->get('v1/autenticado/produtos', 'App\Http\Controllers\ProdutosApi@autenticado');

Route::middleware('auth:sanctum')->get('v1/autenticado/produtos/{id}', 'App\Http\Controllers\ProdutosApi@autenticadoUnico');

Route::middleware('auth:sanctum')->post('v1/autenticado/produtos/editar/{id}', 'App\Http\Controllers\ProdutosApi@autenticadoUpdate');

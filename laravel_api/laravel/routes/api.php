<?php

use App\Http\Controllers\homeController;
use App\Http\Controllers\listController;
use App\Http\Controllers\ClientsController;
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

Route::get('/ping', function(){return 'pong';});

Route::get('/home', [homeController::class, 'index']);

Route::get('/clients/list', [ClientsController::class, 'all']);
Route::post('/clients/adicionar', [ClientsController::class, 'add']);
Route::get('/clients/edit/{client}', [ClientsController::class, 'serchID']);
Route::put('/clients/update/{client}', [ClientsController::class, 'update']);
Route::delete('/clients/delete/{client}', [ClientsController::class, 'delete']);

Route::get('/lista', [listController::class, 'listagem']);
Route::post('/adicionar', [listController::class, 'adicionar']);
Route::get('/editar/{user}', [listController::class, 'editar']);
Route::put('/update/{user}', [listController::class, 'update']);
Route::delete('/delete/{user}', [listController::class, 'delete']);

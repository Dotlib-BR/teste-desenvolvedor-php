<?php

use App\Http\Controllers\Api\AuthController;
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
Route::post('login', [AuthController::class, 'login']);


Route::middleware('auth:api')->group(function () {
    Route::resource('produtos', 'Api\ProdutoController');
    Route::resource('clientes', 'Api\ClienteController');
    Route::resource('pedidos', 'Api\PedidoController')->only(
        [
            'store', 'update'
        ]
    );
});

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

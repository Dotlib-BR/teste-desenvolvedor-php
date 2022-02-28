<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
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

//Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//    return $request->user();
//});

// Login & Signup
Route::post('signup', [UserController::class, 'store']);
Route::post('login', [AuthController::class, 'login']);

// Required Auth
Route::group(['middleware' => ['auth:sanctum']], function () {

    Route::group(['prefix' => 'users'], function () {
        // Users
        Route::get('index', [UserController::class, 'index']);
        Route::post('store', [UserController::class, 'store']);
        Route::put('update/{id}', [UserController::class, 'update']);
        Route::get('show/{id}', [UserController::class, 'show']);
        Route::delete('delete/{id}', [UserController::class, 'destroy']);
    });

    Route::group(['prefix' => 'products'], function () {
        // Products
        Route::get('index', [ProductController::class, 'index']);
        Route::post('store', [ProductController::class, 'store']);
        Route::put('update/{id}', [ProductController::class, 'update']);
        Route::get('show/{id}', [ProductController::class, 'show']);
        Route::delete('delete/{id}', [ProductController::class, 'destroy']);
    });

    Route::group(['prefix' => 'orders'], function () {
        // Orders
        Route::get('index', [OrderController::class, 'index']);
        Route::post('store', [OrderController::class, 'store']);
        Route::put('update/{id}', [OrderController::class, 'update']);
        Route::get('show/{id}', [OrderController::class, 'show']);
        Route::delete('delete/{id}', [OrderController::class, 'destroy']);
    });

});

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

// Login & Signup
//Route::post('signup', [AuthController::class, 'signup']);
//Route::post('login', [AuthController::class, 'login']);
//
//// Required Auth
//Route::group(['middleware' => ['auth:sanctum']], function () {
//
//    Route::group(['middleware' => ['auth_only:Administrador, Cliente']], function (){
//
//        // Users
//        Route::put('user/{id}', [UserController::class, 'update']);
//        Route::get('user/{id}', [UserController::class, 'show']);
//        Route::delete('user/{id}', [UserController::class, 'destroy']);
//
//        // Products
//        Route::get('products', [ProductController::class, 'index']);
//        Route::get('product/{id}', [ProductController::class, 'show']);
//
//        // Orders
//        Route::get('orders', [OrderController::class, 'index']);
//        Route::post('order', [OrderController::class, 'store']);
//        Route::put('order/{id}', [OrderController::class, 'update']);
//        Route::get('order/{id}', [OrderController::class, 'show']);
//        Route::delete('order/{id}', [OrderController::class, 'destroy']);
//
//        Route::group(['middleware' => ['auth_only:Administrador']], function (){
//
//            // Users
//            Route::get('users', [UserController::class, 'index']);
//            Route::post('user', [UserController::class, 'store']);
//
//            // Products
//            Route::post('product', [ProductController::class, 'store']);
//            Route::put('product/{id}', [ProductController::class, 'update']);
//            Route::delete('product/{id}', [ProductController::class, 'destroy']);
//        });
//    });
//});

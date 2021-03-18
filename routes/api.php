<?php

use App\Http\Controllers\api\ApiOrderController;
use App\Http\Controllers\api\ApiProductController;
use App\Http\Controllers\api\ApiUserController;
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
Route::resource('product/list', ApiProductController::class);
Route::resource('user/receive', ApiUserController::class);
Route::resource('orders/bought', ApiOrderController::class);
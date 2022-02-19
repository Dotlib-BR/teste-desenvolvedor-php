<?php

use App\Http\Controllers\Api\ClientController;
use App\Http\Controllers\Api\OrderController;
use App\Http\Controllers\Api\ProductController;
use Illuminate\Support\Facades\Route;

Route::apiResource('client', ClientController::class);
Route::apiResource('product', ProductController::class);
Route::apiResource('order', OrderController::class);

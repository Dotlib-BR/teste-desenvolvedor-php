<?php

use App\Http\Controllers\CostumerController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Models\Order;
use Illuminate\Foundation\Application;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Laravel\Fortify\Http\Controllers\RegisteredUserController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::middleware(['auth:sanctum', 'verified'])->group(function() {

    Route::get('/', function () {
        return redirect()->route('orders.index');
    });

    Route::resource('costumers', CostumerController::class);
    Route::resource('orders', OrderController::class);
    Route::resource('products', ProductController::class);

    Route::put('/orders/{order}/products', function (Order $order, Request $request) {
        if ($order->products()->where('id', $request->product_id)->exists()) {
            $order->products()->updateExistingPivot($request->product_id, [
                'quantity' => $request->quantity + $order->products()->find($request->product_id)->pivot->quantity,
            ]); // APPARENTLY HIGHLY INEFFICIENT // TODO FIX THIS
        } else {
            $order->products()->attach($request->input('product_id'), ['quantity' => $request->input('quantity')]);
        }
        return redirect()->route('orders.show', $order);
    });

    Route::get('/register', [RegisteredUserController::class, 'create'])->name('register');
    Route::post('/register', [RegisteredUserController::class, 'store']);
});




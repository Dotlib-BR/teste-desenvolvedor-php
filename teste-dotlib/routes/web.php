<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;

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





Route::get('/login', function () {
    return view('login');
})->name('login.user');

Route::get('/register', function () {
    return view('register');
})->name('register.user');

Route::get('/about', function () {
    return view('about');
})->name('about');


Route::group(['middleware' => 'authentic'], function () {
    Route::get('/', function () {
        return view('home');
    })->name('home');

});


Route::post('/login', [LoginController::class, 'login'])->name('action.login');
Route::post('/register', [LoginController::class, 'register'])->name('action.register');
Route::get('/logout', [LoginController::class, 'logout'])->name('action.logout');

<?php

use App\Http\Controllers\UsersController;
use App\Http\Controllers\ProdutosController;
use Illuminate\Support\Facades\Route;

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
    return view('welcome');
});


Route::prefix('users')->group(function(){
  Route::get('/',[UsersController::class,'index'])->name('users-index');
  Route::delete('/{Id_cliente}',[UsersController::class,'destroy'])->where('Id_cliente','[0-9]+')->name('users-destroy');
  Route::get('/create',[UsersController::class,'create'])->name('users-create');
  Route::post('/',[UsersController::class,'store'])->name('users-store');
  Route::get('/{Id_cliente}/edit',[UsersController::class,'edit'])->where('Id_cliente','[0-9]+')->name('users-edit');
  Route::put('/{Id_cliente}/',[UsersController::class,'update'])->where('Id_cliente','[0-9]+')->name('users-update');
});

Route::prefix('produtos')->group(function(){
  Route::get('/',[ProdutosController::class,'index'])->name('produtos-index');
  Route::delete('/{Id_produto}',[ProdutosController::class,'destroy'])->where('Id_produto','[0-9]+')->name('produtos-destroy');
  Route::get('/create',[ProdutosController::class,'create'])->name('produtos-create');
  Route::post('/',[ProdutosController::class,'store'])->name('produtos-store');
  Route::get('/{Id_produto}/edit',[ProdutosController::class,'edit'])->where('Id_produto','[0-9]+')->name('produtos-edit');
  Route::put('/{Id_produto}/',[ProdutosController::class,'update'])->where('Id_produto','[0-9]+')->name('produtos-update');
});

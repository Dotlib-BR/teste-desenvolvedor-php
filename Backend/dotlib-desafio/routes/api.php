<?php

use App\Http\Controllers\ClientController;
use Illuminate\Http\Request;


/*********Rotas para clientes**********/
Route::get("clients", "ClientsController@show");
Route::get("clients/{client}", "ClientsController@getOne");
Route::post("clients", "ClientsController@store");
Route::patch("clients/{client}", "ClientsController@update");
Route::delete("clients/{client}", "ClientsController@delete");
/**************************************/

/*********Rotas para produtos**********/
Route::get("products", "ProductsController@show");
Route::get("products/{product}", "ProductsController@getOne");
Route::post("products", "ProductsController@store");
Route::patch("products/{product}", "ProductsController@update");
Route::delete("products/{product}", "ProductsController@delete");
/**************************************/

/*********Rotas para pedidos**********/
Route::get("orders", "OrdersController@show");
Route::get("orders/{order}", "OrdersController@getOne");
Route::post("orders", "OrdersController@store");
Route::patch("orders/{order}", "OrdersController@update");
Route::delete("orders/{order}", "OrdersController@delete");
/**************************************/

<?php

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

Route::get('/', 'LoginController@login')->name('login');
Route::get('/login', 'LoginController@login');
Route::get('/logout', 'LoginController@logout');
Route::post('/authenticate', 'LoginController@authenticate');

Route::group(['prefix' => 'dashboard',  'middleware' => 'auth'],function () {
    Route::get('/','DashboardController@home');
    Route::get('/produto','DashboardController@produto');
});
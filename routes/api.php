<?php

use Illuminate\Http\Request;
use Illuminate\Routing\Router;

/** @var Router $router */

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

$router->group(['prefix' => 'v1'], function () use ($router) {
    $router->get('customers', 'Api\CustomersController@index');


});

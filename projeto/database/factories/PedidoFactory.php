<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Pedido;
use Faker\Generator as Faker;

$factory->define(Pedido::class, function (Faker $faker) {
    return [
        'cliente_id' => factory(App\Cliente::class),             
        'data' => $faker->dateTime(), 
        'status' => $faker->numberBetween(1, 3),
        'valor'=> $faker->randomFloat(2, 100, 1000)
    ];
});

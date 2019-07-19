<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\ItensPedido;
use Faker\Generator as Faker;

$factory->define(ItensPedido::class, function (Faker $faker) {
    return [
        'pedido_id' => factory(App\Pedido::class),
        'produto_id' => factory(App\Produto::class),
        'quantidade' => $faker->randomNumber(2),
        'subtotal'=> $faker->randomFloat(2, 100, 1000)
    ];
});

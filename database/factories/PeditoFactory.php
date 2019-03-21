<?php

use Faker\Generator as Faker;

$factory->define(App\Pedido::class, function (Faker $faker) {
    return [
        'ClienteId' => $faker->numberBetween(1, 50),
        'ProdutoId' => $faker->numberBetween(1, 50),
        'DtPedido' => $faker->dateTime->format('Y-m-d'),
        'Quantidade' => $faker->randomDigitNotNull,
        'Status' => $faker->randomElement([-1, 0, 1])
    ];
});

<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\PedidoProduto;
use Faker\Generator as Faker;

$factory->define(PedidoProduto::class, function (Faker $faker) {

    $valorUnitario = $faker->randomFloat(2, 5, 10);
    $qtd = $faker->numberBetween(1, 5);
    $subtotal = $qtd * $valorUnitario;

    return [
        'pedido_id'     => $faker->numberBetween(1, 25),
        'produto_id'    => $faker->numberBetween(1, 25),
        'quantidade'    => $qtd,
        'valor_unitario' => $valorUnitario,
        'subtotal'      => $subtotal,
    ];
});

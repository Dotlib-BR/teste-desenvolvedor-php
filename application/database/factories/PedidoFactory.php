<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Pedido;
use App\Services\PedidoService;
use Faker\Generator as Faker;

$pedidoService = app(PedidoService::class);

$factory->define(Pedido::class, function (Faker $faker) use($pedidoService) {
    return [
        'cliente_id' => $faker->numberBetween(1, 10),
        'status_pedido_id' => $faker->numberBetween(1, 3),
        'cupom_desconto_id' => null,
        'numero_pedido' =>  $pedidoService->novoNumeroPedido($faker->numberBetween(1, 100)),
        'valor_pedido' => $faker->randomFloat(2, 20, 200),
        'valor_desconto' => $faker->randomFloat(2, 5, 10),
        'valor_total' => $faker->randomFloat(2, 20, 200),
    ];
});

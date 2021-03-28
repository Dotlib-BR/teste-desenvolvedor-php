<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Pedido;
use App\Services\PedidoService;
use Faker\Generator as Faker;

$pedidoService = app(PedidoService::class);

$factory->define(Pedido::class, function (Faker $faker) use($pedidoService, $factory)
{
    $valor = $faker->randomFloat(2, 20, 200);

    return [
        'cliente_id'        => $faker->numberBetween(1, 50),
        'status_pedido_id'  => $faker->numberBetween(1, 3),
        'cupom_desconto_id' => null,
        'numero_pedido'     =>  $pedidoService->novoNumeroPedido(uniqid()),
        'valor_pedido'      => $valor,
        'valor_desconto'    => null, //$faker->randomFloat(2, 5, 10),
        'valor_total'       => $valor,
    ];
});

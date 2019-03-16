<?php

use Faker\Generator;

$factory->define(App\model\PedidoDetalhe::class, function (Generator $faker) {
    return [
        'desconto' => rand (1,10),
        'quantidade' => rand (1,10),
        'pedido_id' => function () {
            return factory(App\model\Pedido::class)->create()->id;
        },
        'produto_id' => function () {
            return factory(App\model\Produto::class)->create()->id;
        }
    ];
});

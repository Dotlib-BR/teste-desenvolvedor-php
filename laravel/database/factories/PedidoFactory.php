<?php

use Faker\Generator;

$factory->define(App\model\Pedido::class, function (Generator $faker) {
    $base = new Faker\Provider\Base($faker);
    return [
        'quantidade' => $base->numberBetween($min = 1, $max = 50),
        'cliente_id' => function () {
            return factory(App\model\Cliente::class)->create()->id;
        },
        'produto_id' => function () {
            return factory(App\model\Produto::class)->create()->id;
        }
    ];
});

<?php

use Faker\Generator;

$factory->define(App\model\Pedido::class, function (Generator $faker) {
    $base = new Faker\Provider\Base($faker);
    $status =['pago','aberto','cancelado'];
    return [
        'status' => $status[rand (0,2)],
        'cliente_id' => function () {
            return factory(App\model\Cliente::class)->create()->id;
        }
    ];
});

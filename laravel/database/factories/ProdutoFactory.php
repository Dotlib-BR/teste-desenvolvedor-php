<?php

use Faker\Generator;

$factory->define(App\model\Produto::class, function (Generator $faker) {
    $barcode = new Faker\Provider\Barcode($faker);
    $base = new Faker\Provider\Base($faker);

    return [
        'nome' => $faker->name,
        'valor' => $base->randomFloat($nbMaxDecimals = 2, $min = 0, $max = 1500),
        'codBarras' => $barcode->ean13(),
        'created_at' => new dateTime(),
        'updated_at' => new dateTime()
    ];
});


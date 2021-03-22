<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Produto;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

$factory->define(Produto::class, function (Faker $faker) {
    return [
        'nome'          => $faker->words(2, true),
        'cod_barras'    => $faker->isbn13,
        'valor'         => $faker->randomFloat(2, 10, 200),
        'qtd_estoque'   => $faker->randomDigit,
        'ativo'         => 1,
    ];
});

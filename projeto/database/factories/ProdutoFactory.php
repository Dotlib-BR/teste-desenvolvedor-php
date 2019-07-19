<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Produto;
use Faker\Generator as Faker;

$factory->define(Produto::class, function (Faker $faker) {
    return [
        'nome' => $faker->word, 
        'descricao' => $faker->text(50), 
        'codbarras' => Str::random(), 
        'valorUnt' => $faker->randomFloat(2, 100, 1000)
    ];
});

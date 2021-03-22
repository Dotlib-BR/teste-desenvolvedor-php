<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\CupomDesconto;
use Faker\Generator as Faker;

$factory->define(CupomDesconto::class, function (Faker $faker) {
    return [
        'nome'  => $faker->words(2, true),
        'codigo' => strtoupper(substr($faker->md5, 0, 10)),
        'tipo'  => 'porcentagem',
        'valor' => $faker->numberBetween(5, 60)
    ];
});

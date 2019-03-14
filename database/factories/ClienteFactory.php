<?php

use Faker\Generator as Faker;

$factory->define(App\Cliente::class, function (Faker $faker) {
    return [
        'Nome' => $faker->name,
        'CPF' => $faker->numerify('###########')
    ];
});

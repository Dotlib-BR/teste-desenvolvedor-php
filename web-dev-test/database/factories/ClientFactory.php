<?php

use Faker\Generator as Faker;

$factory->define(App\Client::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'cpf' => $faker->numerify('###########'),
        'email' => $faker->unique()->safeEmail
    ];
});

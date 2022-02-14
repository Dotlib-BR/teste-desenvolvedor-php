<?php

use Illuminate\Support\Str;
use Faker\Generator as Faker;

$factory->define(App\Client::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'cpf' => Str::random(11),
        'email' => $faker->unique()->safeEmail,
        'password' => $faker->password
    ];
});

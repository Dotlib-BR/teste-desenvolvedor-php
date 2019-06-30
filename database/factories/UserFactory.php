<?php

use App\Models\User;
use Faker\Generator as Faker;

$factory->define(User::class, function(Faker $faker) {
    return [
        'name'      => $faker->name,
        'email'     => $faker->unique()->safeEmail,
        'password'  => bcrypt('dotlib'),
        'document'  => $faker->unique()->cpf(false)
    ];
});

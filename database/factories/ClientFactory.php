<?php

use App\Models\Client;
use App\Models\User;
use Faker\Generator as Faker;

$factory->define(Client::class, function (Faker $faker) {
    $cpf = '';
    
    for ($i = 0; $i<11; $i++) {
        $cpf .= mt_rand(0,9);
    }

    return [
        'user_id' => User::all()->random()->id,
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'cpf' => $cpf,
    ];
});

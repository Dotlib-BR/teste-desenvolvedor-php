<?php

$factory->define(App\Models\Client::class, function (Faker\Generator $faker) {
    $faker->addProvider(new Faker\Provider\pt_BR\Person($faker));

    return [
        'name' => $faker->name,
        'cpf' => \Illuminate\Support\Str::random(11),
        'email' => null
    ];
});

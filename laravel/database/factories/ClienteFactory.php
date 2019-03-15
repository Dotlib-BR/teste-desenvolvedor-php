<?php

use Faker\Generator;

$factory->define(App\model\Cliente::class, function (Generator $faker) {
    $person = new Faker\Provider\pt_BR\Person($faker);

    return [
        'nome' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'cpf' => $person->cpf(false) ,
        'created_at' => new dateTime(),
        'updated_at' => new dateTime()
    ];
});


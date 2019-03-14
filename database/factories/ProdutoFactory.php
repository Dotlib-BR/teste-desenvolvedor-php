<?php

use Faker\Generator as Faker;

$factory->define(App\Produto::class, function (Faker $faker) {
    $produtos = [
        'Caneta', 'Lápis', 'Borracha', 'Caderno', 'Papel', 'Mochila', 'Corretivo', 'Lapiseira',
        'Livro', 'Agenda', 'Grampeador', 'Cola', 'Régua'
    ];

    $cores = [
        'Azul', 'Amarelo', 'Verde', 'Vermelho', 'Preto', 'Rosa', 'Laranja', 'Roxo', 'Lilás', 'Bege'
    ];

    return [
        'CodBarras' => $faker->numerify('####################'),
        'Nome' => $faker->randomElement($produtos) . ' ' . $faker->randomElement($cores),
        'ValorUnitario' => $faker->randomNumber(2)
    ];
});

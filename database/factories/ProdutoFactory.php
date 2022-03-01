<?php

namespace Database\Factories;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Produto;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class ProdutoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'NomeProduto' => Str::random(8),
            'CodBarras' => $this->faker->isbn13,
            'ValorUnitario' => mt_rand(10,10000) / 100,
        ];
    }
}

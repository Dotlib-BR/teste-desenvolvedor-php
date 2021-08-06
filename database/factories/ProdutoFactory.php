<?php

namespace Database\Factories;

use App\Models\Produto;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProdutoFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Produto::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'NomeProduto' => $this->faker->streetName(),
            'CodBarras' => $this->faker->numerify('####################'),
            'Valor' => $this->faker->randomNumber(3)
        ];
    }
}

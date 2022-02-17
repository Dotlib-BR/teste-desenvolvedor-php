<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ProdutosFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'cod_barras' => $this->faker->isbn13(),
            'nome' => $this->faker->name(),
            'valor' => $this->faker->randomFloat(1, 25, 250),
            'quantidade' => $this->faker->numberBetween(1, 90),
            'status' => $this->faker->numberBetween(0, 1)
        ];
    }
}

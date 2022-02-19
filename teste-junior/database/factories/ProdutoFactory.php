<?php

namespace Database\Factories;

use App\Models\Produto;


use Illuminate\Database\Eloquent\Factories\Factory;

class ProdutoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
          'Nome_produto' => $this->faker->safeColorName(). "" .$this->faker->colorName(),
          'CodBarras' => $this->faker->isbn10(),
          'ValorUnitario' => $this->faker->buildingNumber(),
        ];
    }



}

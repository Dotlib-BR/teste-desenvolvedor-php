<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'bar_code' => $this->faker->unique()->ean13(),
            'name' => $this->faker->text(20),
            'price' => $this->faker->randomFloat(2,20,2000)
        ];
    }
}

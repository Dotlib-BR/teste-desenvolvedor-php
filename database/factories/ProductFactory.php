<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'code' => $this->faker->unique()->numerify('#####'),
            'name' => $this->faker->sentence(nbWords: 2),
            'warehouse_quantity' => $this->faker->randomNumber(nbDigits: 2),
            'value' => $this->faker->randomFloat(nbMaxDecimals: 2, max: 10^5),
        ];
    }
}

<?php

namespace Database\Factories;

use Carbon\Carbon;
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
            'name' => $this->faker->colorName(),
            'unit_value' => $this->faker->randomFloat(null, 1, 10),
            'bar_code' => $this->faker->numberBetween(1000000000000000000, 99999999999999999999),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
    }
}

<?php

namespace Database\Factories;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductRequestFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'product_id' => $this->faker->numberBetween(1, 100),
            'request_id' => $this->faker->numberBetween(1, 50),
            'qtd' => $this->faker->numberBetween(1, 20),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
    }
}

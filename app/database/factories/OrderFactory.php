<?php

namespace Database\Factories;

use App\Models\Costumer;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory
 */
class OrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'bought_at' => $this->faker->dateTimeBetween('-1 year', 'now'),
            'costumer_id' => Costumer::factory(),
        ];
    }
}

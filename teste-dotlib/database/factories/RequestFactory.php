<?php

namespace Database\Factories;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

class RequestFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'client_id' => $this->faker->numberBetween(2, 12),
            'date' => $this->faker->dateTimeThisYear(),
            'status_id' => $this->faker->numberBetween(1, 3),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
    }
}

<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ApplicationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'job_id' => $this->faker->randomElement([1, 2, 3]),
            'candidate_id' => $this->faker->randomElement([1, 2, 3]),
            'application_date' => $this->faker->dateTimeBetween('-1 year', 'now'),
        ];
    }
}

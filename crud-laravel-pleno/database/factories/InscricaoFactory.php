<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class InscricaoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'vaga_id' => $this->faker->randomElement([1, 2, 3]),
            'candidato_id' => $this->faker->randomElement([1, 2, 3]),
            'data_inscricao' => $this->faker->dateTimeBetween('-1 year', 'now'),
        ];
    }
}

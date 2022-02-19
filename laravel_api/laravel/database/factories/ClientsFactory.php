<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ClientsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name(),
            'cpf' => $this->faker->numerify('###########'),
            'email' => $this->faker->freeEmail(),
            'phone' => $this->faker->numerify('##########'),
            'sex' => $this->faker->numberBetween(0, 2),
            'cep' => $this->faker->numerify('########'),
            'address' => $this->faker->secondaryAddress(),
            'complement' => $this->faker->buildingNumber(),
            'city' => $this->faker->city(),
            'date_birth' => $this->faker->date(),
            'stats' => $this->faker->numberBetween(0, 1),
        ];
    }
}

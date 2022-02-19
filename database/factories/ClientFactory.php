<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ClientFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'cpf' => $this->faker->randomNumber(3, true) . "." 
                . $this->faker->randomNumber(3, true) . "." 
                . $this->faker->randomNumber(3, true) . "-" 
                . $this->faker->randomNumber(2, true),
            'name' => $this->faker->unique()->name(),
            'email' => $this->faker->unique()->email(),
        ];
    }
}

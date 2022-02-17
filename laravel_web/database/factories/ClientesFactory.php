<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ClientesFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {   
        return [
            'nome' => $this->faker->name(),
            'email' => $this->faker->freeEmail(),
            'cpf' => $this->faker->numerify('###########'),
            'celular' => $this->faker->tollFreePhoneNumber(),
            'data_nascimento' => $this->faker->date(),
            'status' => $this->faker->numberBetween(0, 1)
        ];
    }
}

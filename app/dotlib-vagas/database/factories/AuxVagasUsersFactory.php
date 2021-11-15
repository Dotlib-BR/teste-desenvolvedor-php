<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class AuxVagasUsersFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return
        [
            'user_id'=> rand(1,60),
            'vaga_id'=> rand(1,60)
        ];
    }
}

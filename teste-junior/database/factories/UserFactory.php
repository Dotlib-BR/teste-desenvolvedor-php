<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
      return [
          'name' => $this->faker->firstname(),
          'segundo_nome' => $this->faker->lastname(),
          'cpf' => $this->faker->randomDigit(). "" .$this->faker->isbn10(),
          'email' => Str::random(10),
          'email_verified_at' => now(),
          'password' => Str::random(10), // password
          
      ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function unverified()
    {
        return $this->state(function (array $attributes) {
            return [
                'email_verified_at' => null,
            ];
        });
    }
}

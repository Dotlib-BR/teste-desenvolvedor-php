<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\Factories\Factory;

class UserFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = User::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {

        $gender = $this->faker->randomElement(['male', 'female']);

        return [
            'name' => $this->faker->firstName($gender),
            'last_name' => $this->faker->lastName(),
            'document' => $this->faker->cpf(false),
            'email' => $this->faker->unique()->safeEmail,
            'password' => Hash::make('123456'),
        ];
    }
}

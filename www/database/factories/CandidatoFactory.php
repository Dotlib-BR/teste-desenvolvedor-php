<?php

namespace Database\Factories;

use App\Models\Candidato;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class CandidatoFactory extends Factory
{

    protected $model = Candidato::class;
    /**
     * Define the model's default state.
     *
     * @return array
     */

    public function withFaker()
    {
        return \Faker\Factory::create('pt_BR');
    }

    public function definition()
    {
        return [
            'user_id' => User::factory()->state(['perfil' => 'candidato'])->create()->id,
            'cpf' => $this->faker->cpf,
            'nome' => $this->faker->firstName(),
            'sobrenome' => $this->faker->lastName(),
            'data_nascimento' => $this->faker->date('Y-m-d', '2005-12-31'),
            'genero' => $this->faker->randomElement(['M','F','N']),
            'endereco' => $this->faker->address(),
            'telefone' => $this->faker->phoneNumber(),
            'celular' => $this->faker->phoneNumber(),
            'email' => $this->faker->email(),
        ];
    }
}

<?php

namespace Database\Factories;

use App\Models\Empresa;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class EmpresaFactory extends Factory
{

    protected $model = Empresa::class;
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
            'user_id' => User::factory()->state(['perfil' => 'empresa'])->create()->id,
            'cnpj' => $this->faker->cnpj,
            'nome' => $this->faker->company(),
            'endereco' => $this->faker->address(),
            'telefone' => $this->faker->phoneNumber(),
            'celular' => $this->faker->phoneNumber(),
            'email' => $this->faker->email(),
        ];
    }
}

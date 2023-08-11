<?php

namespace Database\Factories;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Vaga;

class VagaFactory extends Factory
{
    protected $model = Vaga::class;

    public function definition()
    {
        return [
            'nome' => $this->faker->jobTitle,
            'tipo' => $this->faker->randomElement(['CLT', 'Pessoa Jurídica', 'Freelancer']),
            'status' => $this->faker->randomElement(['ativo', 'pausado']),
            'email' => $this->faker->unique()->safeEmail,
        ];
    }
    public function show(Vaga $vaga)
{
    $candidatos = $vaga->candidatos; // Obtém os candidatos para esta vaga

    return view('vagas.show', compact('vaga', 'candidatos'));
}

}

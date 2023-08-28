<?php

namespace Database\Factories;

use App\Models\Candidato;
use App\Models\Inscricao;
use Illuminate\Database\Eloquent\Factories\Factory;

class CandidatoFactory extends Factory
{
    protected $model = Candidato::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->name,
            'email' => $this->faker->unique()->safeEmail,
            'experiencia_profissional' => $this->faker->paragraph,
            'habilidades' => $this->faker->sentence,
            'disponibilidade' => $this->faker->randomElement(['Integral', 'Meio Período']),
            'created_at' => $this->faker->dateTimeBetween('-1 year', 'now'),
            'updated_at' => now(),
        ];
    }

    // Definindo relacionamento com inscrições
    public function configure()
    {
        return $this->afterCreating(function (Candidato $candidato) {
            $candidato->inscricoes()->createMany(
                Inscricao::factory()->count(3)->raw()
            );
        });
    }
}

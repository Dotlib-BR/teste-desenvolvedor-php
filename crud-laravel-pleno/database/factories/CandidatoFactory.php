<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class CandidatoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name,
            'email' => fake()->unique()->safeEmail, // Email do Candidato
            'experiencia_profissional' => fake()->paragraph, // Experiência Profissional
            'habilidades' => fake()->sentence, // Habilidades
            'disponibilidade' => fake()->randomElement(['Integral', 'Meio Período']), // Disponibilidade
            'created_at' => fake()->dateTimeBetween('-1 year', 'now'),
            'updated_at' => now(), // Data de Modificacão
        ];
    }
}

<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class VagaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'titulo' => fake()->sentence, // Uma descrição curta para o titulo
            'descricao' => fake()->paragraph, // Paragrafo
            'tipo' => fake()->randomElement(['CLT', 'Pessoa Jurídica', 'Freelancer']), // Tipo de vaga
            'status' => fake()->randomElement(['Ativa', 'Pausada', 'Encerrada']), // Status da vaga
            'created_at' => fake()->dateTimeBetween('-1 year', 'now'), // Data, sendo criada 12 meses atrás a partir da hora de criação
            'updated_at' => now(), // Data modificação da vaga           
        ];
    }
}

<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Inscricao>
 */
class InscricaoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            // Escolheremos um id aleatorio na vaga_id e candidato para associar à inscrição, assumindo que já tenha os id's da vaga e candidato.
            'vaga_id' => $this->faker->randomElement([1, 2, 3]),
            'candidato_id' => $this->faker->randomElement([1, 2, 3]),
            'data_inscricao' => $this->faker->dateTimeBetween('-1 year', 'now'), // Criando inscrições de 1 ano atrás para gerar dados relevantes para os testes.
        ];
    }
}

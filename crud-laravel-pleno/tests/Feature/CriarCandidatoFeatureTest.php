<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CriarCandidatoFeatureTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    /** @test */
    public function criar_candidato()
    {
        $dadosCandidato = [
            'nome' => $this->faker->name,
            'email' => $this->faker->unique()->safeEmail,
            'experiencia_profissional' => $this->faker->paragraph,
            'habilidades' => $this->faker->sentence,
            'disponibilidade' => $this->faker->sentence,
        ];

        $response = $this->post('/candidatos', $dadosCandidato);

        $response->assertStatus(201);
        $response->assertJson(['nome' => $dadosCandidato['nome']]); // Verificando resposta com o nome do candidato
    }

}

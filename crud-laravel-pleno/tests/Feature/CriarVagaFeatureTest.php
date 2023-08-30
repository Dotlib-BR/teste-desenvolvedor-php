<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CriarVagaFeatureTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    /** @test */
    public function criar_vaga()
    {
        $dadosVaga = [
            'titulo' => $this->faker->sentence,
            'descricao' => $this->faker->paragraph,
            'tipo' => 'CLT',
            'status' => $this->faker->randomElement(['Ativa', 'Pausada', 'Encerrada']),
        ];

        $response = $this->post('/vagas', $dadosVaga);

        $response->assertStatus(201);
        $response->assertJson(['titulo' => $dadosVaga['titulo']]); // Verificando se na resposta retorna o título da vaga
    }

}

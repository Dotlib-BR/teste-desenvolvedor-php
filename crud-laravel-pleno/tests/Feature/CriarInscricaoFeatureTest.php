<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CriarInscricaoFeatureTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    /** @test */
    public function criar_inscricao()
    {
        $dadosInscricao = [
            'candidato_id' => 1,
            'vaga_id' => 1,
            'data_inscricao' => now()->toDateString(),
        ];

        $response = $this->post('/inscricoes', $dadosInscricao);

        $response->assertStatus(201);
        $response->assertJson(['candidato_id' => $dadosInscricao['candidato_id']]); // Verificando se o retorno contém o ID do candidato
    }

}

<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\Vaga; // Importe o modelo Vaga
use App\Models\Candidato; // Importe o modelo Candidato

class CriarInscricaoFeatureTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    /** @test */
    public function criar_inscricao()
    {
        // Criar um usuário de teste
        $user = User::factory()->create();

        // Autentica o user
        $this->actingAs($user);

        // Crie uma vaga e um candidato para uso no teste
        $vaga = Vaga::factory()->create();
        $candidato = Candidato::factory()->create();

        $dadosInscricao = [
            'candidato_id' => $candidato->id, // Use o ID do candidato criado
            'vaga_id' => $vaga->id, // Use o ID da vaga criada
            'data_inscricao' => now()->toDateString(),
        ];

        $response = $this->post('/inscricoes', $dadosInscricao);

        $response->assertStatus(201);
        $response->assertJson(['candidato_id' => $dadosInscricao['candidato_id']]);
    }
}

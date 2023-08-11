<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Candidato;

class CandidatoControllerTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    public function testListaCandidatos()
    {
        Candidato::factory()->count(3)->create();

        $response = $this->get(route('candidatos.index'));

        $response->assertStatus(200);
        $response->assertViewIs('candidatos.index');
        $response->assertViewHas('candidatos');
    }

    public function testCriaCandidato()
    {
        $candidatoData = Candidato::factory()->raw();

        $response = $this->post(route('candidatos.store'), $candidatoData);

        $response->assertStatus(302);
        $response->assertRedirect(route('candidatos.index'));

        $this->assertDatabaseHas('candidatos', $candidatoData);
    }

    public function testEditaCandidato()
    {
        $candidato = Candidato::factory()->create();
        $novosDados = [
            'nome' => 'Novo Candidato',
            // Adicione outros campos que deseja testar
        ];

        $response = $this->put(route('candidatos.update', $candidato->id), $novosDados);

        $response->assertStatus(302);
        $response->assertRedirect(route('candidatos.index'));

        $this->assertDatabaseHas('candidatos', $novosDados);
    }

    public function testExcluiCandidato()
    {
        $candidato = Candidato::factory()->create();

        $response = $this->delete(route('candidatos.destroy', $candidato->id));

        $response->assertStatus(302);
        $response->assertRedirect(route('candidatos.index'));

        $this->assertDeleted($candidato);
    }
}

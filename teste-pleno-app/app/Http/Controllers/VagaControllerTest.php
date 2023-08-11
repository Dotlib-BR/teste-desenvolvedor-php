<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Vaga;

class VagaControllerTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    public function testListaVagas()
    {
        Vaga::factory()->count(3)->create();

        $response = $this->get(route('vagas.index'));

        $response->assertStatus(200);
        $response->assertViewIs('vagas.index');
        $response->assertViewHas('vagas');
    }

    public function testCriaVaga()
    {
        $vagaData = Vaga::factory()->raw();

        $response = $this->post(route('vagas.store'), $vagaData);

        $response->assertStatus(302);
        $response->assertRedirect(route('vagas.index'));

        $this->assertDatabaseHas('vagas', $vagaData);
    }

    public function testEditaVaga()
    {
        $vaga = Vaga::factory()->create();
        $novosDados = [
            'nome' => 'Nova Vaga',
            'tipo' => 'Pessoa Jurídica',
            'status' => 'ativo',
            'email' => $this->faker->email,
        ];

        $response = $this->put(route('vagas.update', $vaga->id), $novosDados);

        $response->assertStatus(302);
        $response->assertRedirect(route('vagas.index'));

        $this->assertDatabaseHas('vagas', $novosDados);
    }

    public function testExcluiVaga()
    {
        $vaga = Vaga::factory()->create();

        $response = $this->delete(route('vagas.destroy', $vaga->id));

        $response->assertStatus(302);
        $response->assertRedirect(route('vagas.index'));

        $this->assertDeleted($vaga);
    }
}

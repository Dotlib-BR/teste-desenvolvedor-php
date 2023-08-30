<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Vaga;

class VagaUnitTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    /** @test */
    public function criar_vaga()
    {
        $dadosVaga = [
            'titulo' => 'VagaTest',
            'descricao' => $this->faker->paragraph,
            'tipo' => 'CLT',
            'status' => $this->faker->randomElement(['Ativa', 'Pausada', 'Encerrada']),
            'created_at' => $this->faker->dateTimeBetween('-1 year', 'now'),
            'updated_at' => now(),
        ];

        $vaga = Vaga::create($dadosVaga);

        $this->assertInstanceOf(Vaga::class, $vaga);
        $this->assertSame($dadosVaga['titulo'], $vaga->titulo);
    }

    /** @test */
    public function alterar_vaga()
    {
        $vaga = Vaga::factory()->create();

        $novoTitulo = 'Novo Título';
        $vaga->titulo = $novoTitulo;
        $vaga->save();

        $this->assertSame($novoTitulo, $vaga->fresh()->titulo);
    }

    /** @test */
    public function apagar_vaga()
    {
        $vaga = Vaga::factory()->create();

        $vaga->delete();

        $this->assertDatabaseMissing('vagas', ['id' => $vaga->id]);
    }




    /** @test */
    public function recuperar_vaga()
    {
        $vaga = Vaga::factory()->create();

        $vagaRecuperada = Vaga::find($vaga->id);

        $this->assertInstanceOf(Vaga::class, $vagaRecuperada);
        $this->assertEquals($vaga->titulo, $vagaRecuperada->titulo);
    }
}

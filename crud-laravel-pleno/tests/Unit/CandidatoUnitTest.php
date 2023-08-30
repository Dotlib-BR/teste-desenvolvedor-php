<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Candidato;

class CandidatoUnitTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    /** @test */
    public function criar_candidato()
    {
        $dadosCandidato = [
            'name' => $this->faker->name,
            'email' => $this->faker->unique()->safeEmail,
            'experiencia_profissional' => $this->faker->paragraph,
            'habilidades' => $this->faker->sentence,
            'disponibilidade' => $this->faker->randomElement(['Integral', 'Meio Período']),
            'created_at' => $this->faker->dateTimeBetween('-1 year', 'now'),
            'updated_at' => now(),
        ];

        $candidato = Candidato::create($dadosCandidato);

        $this->assertInstanceOf(Candidato::class, $candidato);
        $this->assertSame($dadosCandidato['name'], $candidato->name);
    }

    /** @test */
    public function atualizar_candidato()
    {
        $candidato = Candidato::factory()->create();

        $novosDados = [
            'name' => $this->faker->name,
            'email' => $this->faker->unique()->safeEmail,
            'experiencia_profissional' => $this->faker->paragraph,
            'habilidades' => $this->faker->sentence,
            'disponibilidade' => $this->faker->randomElement(['Integral', 'Meio Período']),
        ];

        $candidato->update($novosDados);

        $this->assertSame($novosDados['name'], $candidato->name);
        $this->assertSame($novosDados['email'], $candidato->email);
    }

    /** @test */
    public function excluir_candidato()
    {
        $candidato = Candidato::factory()->create();

        $candidato->delete();

        $this->assertDatabaseMissing('candidatos', ['id' => $candidato->id]);
    }

    /** @test */
    public function recuperar_candidato()
    {
        $candidato = Candidato::factory()->create();

        $candidatoRecuperado = Candidato::find($candidato->id);

        $this->assertInstanceOf(Candidato::class, $candidatoRecuperado);
        $this->assertSame($candidato->name, $candidatoRecuperado->name);
    }
}
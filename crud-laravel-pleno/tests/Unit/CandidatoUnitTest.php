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
            'experiencia_profissional' => 'Teste de experiencia profissional para teste unitário',
            'habilidades' => $this->faker->sentence,
            'disponibilidade' => $this->faker->randomElement(['Integral', 'Meio Período']),
        ];

        $candidato = Candidato::create($dadosCandidato);

        $this->assertInstanceOf(Candidato::class, $candidato);
        $this->assertSame($dadosCandidato['name'], $candidato->name);
        $this->assertSame($dadosCandidato['experiencia_profissional'], $candidato->experiencia_profissional); // Verifica a experiência profissional
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

}

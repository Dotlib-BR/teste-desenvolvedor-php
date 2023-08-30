<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Inscricao;
use App\Models\Vaga;
use App\Models\Candidato;
use Illuminate\Foundation\Testing\RefreshDatabase;

class InscricaoUnitTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function pode_criar_uma_inscricao()
    {
        $vaga = Vaga::factory()->create();
        $candidato = Candidato::factory()->create();

        $inscricao = Inscricao::create([
            'vaga_id' => $vaga->id,
            'candidato_id' => $candidato->id,
            'data_inscricao' => now(),
        ]);

        $this->assertInstanceOf(Inscricao::class, $inscricao);
        $this->assertEquals($vaga->id, $inscricao->vaga_id);
        $this->assertEquals($candidato->id, $inscricao->candidato_id);
    }
}

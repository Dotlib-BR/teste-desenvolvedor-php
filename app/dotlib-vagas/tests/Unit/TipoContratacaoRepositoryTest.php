<?php

namespace Tests\Unit;

use App\Models\TipoContratacao;
use App\Repository\TipoContratacaoRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;


class TipoContratacaoRepositoryTest extends TestCase
{
    use DatabaseTransactions;

    /**
     * @test
     */
    public function verificar_listagem_tipo_contratacao_carregamento_dados()
    {
        $tipoContratacaoRepository = new TipoContratacaoRepository(new TipoContratacao());

        $result = $tipoContratacaoRepository->getListaTipoContratacao();

        $this->assertNotEmpty($result);
    }
}

<?php

namespace Tests\Unit;

use App\Models\TipoContratacao;
use PHPUnit\Framework\TestCase;

class TipoContratacaoTest extends TestCase
{
    /**
     * @test
     */
    public function verificar_colunas_correto()
    {
       $tipoContratacao = new TipoContratacao();

       $expected = [
           'id',
           'descricao'
       ];

       $arrayDiff = array_diff($expected, $tipoContratacao->getFillable());

       $this->assertEquals(0,count($arrayDiff));
    }
}

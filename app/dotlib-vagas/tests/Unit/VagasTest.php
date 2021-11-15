<?php

namespace Tests\Unit;

use App\Models\Vaga;
use PHPUnit\Framework\TestCase;

class VagasTestTest extends TestCase
{
    /**
     * @test
     */
    public function verificar_colunas_correto()
    {
       $vaga = new Vaga();

       $expected = [
           'id',
           'titulo',
           'descricao',
           'requisito_obrigatorio',
           'requisito_diferencial',
           'beneficios',
           'tipo_contratacao_id',
           'salario',
           'alocacao',
           'pausada'
       ];

       $arrayDiff = array_diff($expected, $vaga->getFillable());

       $this->assertEquals(0,count($arrayDiff));
    }

    /**
     * @test
     */
    public function verificar_atributo_salario_formatado()
    {
        $vaga = new Vaga();
        $vaga->salario = 5100.00;

        $this->assertTrue(strpos($vaga->getSalario(), ',') > 0);
    }


}

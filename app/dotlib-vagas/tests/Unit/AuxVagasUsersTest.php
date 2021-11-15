<?php

namespace Tests\Unit;

use App\Models\AuxVagasUsers;
use PHPUnit\Framework\TestCase;

class AuxVagasUsersTest extends TestCase
{
    /**
     * @test
     */
    public function verificar_colunas_correto()
    {
        $auxVagasUsers = new AuxVagasUsers();

       $expected = [
           'id',
           'user_id',
           'vaga_id'
       ];

       $arrayDiff = array_diff($expected, $auxVagasUsers->getFillable());

       $this->assertEquals(0,count($arrayDiff));
    }


}

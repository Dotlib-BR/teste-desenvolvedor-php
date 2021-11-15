<?php

namespace Tests\Unit;

use App\Models\User;
use PHPUnit\Framework\TestCase;

class UserTest extends TestCase
{
    /**
     * @test
     */
    public function verificar_colunas_correto()
    {
       $user = new User();

       $expected = [
           'name',
           'last_name',
           'telefone',
           'email',
           'password'
       ];

       $arrayDiff = array_diff($expected, $user->getFillable());

       $this->assertEquals(0,count($arrayDiff));
    }
}

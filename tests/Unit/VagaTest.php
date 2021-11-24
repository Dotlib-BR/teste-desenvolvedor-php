<?php

namespace Tests\Unit;

use Tests\TestCase;

class VagaTest extends TestCase
{
    /**
     * @test
     */
    //VERIFICA SE O FORMULARIO PARA CADASTRAR VAGAS EXISTE
    public function vagas_formulario()
    {
        $this->withoutExceptionHandling();
        $response = $this->get('/announcementViews');
        $response->assertStatus(200);
    }
}

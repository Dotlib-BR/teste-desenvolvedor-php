<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ClienteTest extends TestCase
{
    /**'
     * Testa a criação de clientes
     *
     * @return void
     */
    public function test_rota_clientes_view()
    {
        $response = $this->get('/client');

        $response->assertStatus(200);
    }

    public function test_rota_clientes_conteudo()
    {
        $response = $this->get('/client');

        $response->assertSee('Clientes Cadastrados');
    }

    public function test_get_pagina_incluir_cliente_status_200()
    {
        $response = $this->get('/client/create');

        $response->assertStatus(200);
    }

    public function test_get_pagina_incluir_cliente_conteudo()
    {
        $response = $this->get('/client/create');

        $response->assertSee('Cadastrar Novo Cliente');
    }

    public function test_post_incluir_cliente_conteudo()
    {
        $response = $this->post('/client/create');

        $response->assertSee();
    }


}

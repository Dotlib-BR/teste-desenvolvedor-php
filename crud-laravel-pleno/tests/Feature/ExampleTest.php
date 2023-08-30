<?php

namespace Tests\Feature;

use Tests\TestCase;

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     */
    public function testa_redirecionamento_da_pagina(): void
    {
        $response = $this->get('/');

        $response->assertStatus(302);
    }
}

<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CriarUserFeatureTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    /** @test */
    public function criar_usuario()
    {
        $dadosUsuario = [
            'name' => $this->faker->name,
            'email' => $this->faker->unique()->safeEmail,
            'password' => 'password',
            'nivel_acesso' => 'Usuario',
        ];

        $response = $this->post('/users', $dadosUsuario);

        $response->assertStatus(201);
        $response->assertJson(['name' => $dadosUsuario['name']]); // Verifica o JSON com respossta contendo o nome do usuario
    }
}

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

        $response->assertStatus(201); // Verificando se a criação do usuário foi bem sucedida
        $response->assertJson(['name' => $dadosUsuario['name']]); // Verificando se o JSON de resposta contém o nome do usuário
    }
}

<?php 

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;

class CriarUserFeatureAuthTest extends TestCase
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

        $user = User::factory()->create();

        // Testa com usuario autenticado
        $this->actingAs($user);

        $response = $this->post('/users', $dadosUsuario);

        $response->assertStatus(201);
        $response->assertJson(['name' => $dadosUsuario['name']]);
    }
}

<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;

class CreateUserFeatureAuthTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    /** @test */
    public function can_create_user()
    {
        $userData = [
            'name' => $this->faker->name,
            'email' => $this->faker->unique()->safeEmail,
            'password' => 'password',
            'access_level' => 'Usuario',
        ];

        $user = User::factory()->create();

        // Test with authenticated user
        $this->actingAs($user);

        $response = $this->post('/users', $userData);

        $response->assertStatus(201);
        $response->assertJson(['name' => $userData['name']]);
    }
}

<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CreateUserFeatureTest extends TestCase
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

        $response = $this->post('/users', $userData);

        $response->assertStatus(302); // Verify the redirection to the login page
        $response->assertRedirect(route('login'));
    }
}

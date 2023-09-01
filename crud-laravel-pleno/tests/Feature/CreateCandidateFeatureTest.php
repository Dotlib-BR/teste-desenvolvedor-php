<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CreateCandidateFeatureTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    /** @test */
    public function can_create_candidate()
    {
        $candidateData = [
            'name' => $this->faker->name,
            'email' => $this->faker->unique()->safeEmail,
            'experiencia_profissional' => $this->faker->paragraph,
            'habilidades' => $this->faker->sentence,
            'disponibilidade' => $this->faker->randomElement(['Integral', 'Meio Período']),
        ];

        $response = $this->post('/candidates', $candidateData);

        $response->assertRedirect(route('login')); // Verifying if it redirects to the login page after redirect
    }
}

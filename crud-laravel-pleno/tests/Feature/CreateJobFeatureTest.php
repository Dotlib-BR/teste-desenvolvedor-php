<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CreateJobFeatureTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    /** @test */
    public function can_create_job()
    {
        $jobData = [
            'title' => $this->faker->sentence,
            'description' => $this->faker->paragraph,
            'type' => 'CLT',
            'status' => $this->faker->randomElement(['Active', 'Paused', 'Closed']),
        ];

        $response = $this->post('/jobs', $jobData);

        $response->assertStatus(302);
        $response->assertRedirect(route('login')); // Verifying if it redirects to the login page after redirect
    }
}

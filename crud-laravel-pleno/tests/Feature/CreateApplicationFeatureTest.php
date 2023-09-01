<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\Job; // Import the Job model
use App\Models\Candidate; // Import the Candidate model

class CreateApplicationFeatureTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    /** @test */
    public function can_create_application()
    {
        // Create a test user
        $user = User::factory()->create();

        // Authenticate the user
        $this->actingAs($user);

        // Create a job and a candidate for use in the test
        $job = Job::factory()->create();
        $candidate = Candidate::factory()->create();

        $applicationData = [
            'candidate_id' => $candidate->id, // Use the ID of the created candidate
            'job_id' => $job->id, // Use the ID of the created job
            'application_date' => now()->toDateString(),
        ];

        $response = $this->post('/applications', $applicationData);

        $response->assertStatus(201);
        $response->assertJson(['candidate_id' => $applicationData['candidate_id']]);
    }
}

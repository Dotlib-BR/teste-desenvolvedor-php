<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;

class CreateUserFeatureTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    /** @test */
    public function authenticated_user_can_create_application()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->post(route('applications.apply', 1));

        $response->assertStatus(302); // Verify the redirection after applying
        $response->assertRedirect(route('jobs.index'));
    }
}

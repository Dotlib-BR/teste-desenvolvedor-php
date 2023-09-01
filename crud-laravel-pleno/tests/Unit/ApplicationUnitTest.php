<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Application;
use App\Models\Job;
use App\Models\Candidate;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ApplicationUnitTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function can_create_an_application()
    {
        $job = Job::factory()->create();
        $candidate = Candidate::factory()->create();

        $application = Application::create([
            'job_id' => $job->id,
            'candidate_id' => $candidate->id,
            'application_date' => now(),
        ]);

        $this->assertInstanceOf(Application::class, $application);
        $this->assertEquals($job->id, $application->job_id);
        $this->assertEquals($candidate->id, $application->candidate_id);
    }
}

<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Job;

class JobUnitTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    /** @test */
    public function can_create_job()
    {
        $jobData = [
            'title' => 'TestJob',
            'description' => $this->faker->paragraph,
            'type' => 'CLT',
            'status' => $this->faker->randomElement(['Active', 'Paused', 'Closed']),
        ];

        $job = Job::create($jobData);

        $this->assertInstanceOf(Job::class, $job);
        $this->assertSame($jobData['title'], $job->title);
    }

    /** @test */
    public function can_update_job()
    {
        $job = Job::factory()->create();

        $newTitle = 'New Title';
        $job->title = $newTitle;
        $job->save();

        $this->assertSame($newTitle, $job->fresh()->title);
    }

    /** @test */
    public function can_delete_job()
    {
        $job = Job::factory()->create();

        $job->delete();

        $this->assertDatabaseMissing('jobs', ['id' => $job->id]);
    }

    /** @test */
    public function can_retrieve_job()
    {
        $job = Job::factory()->create();

        $retrievedJob = Job::find($job->id);

        $this->assertInstanceOf(Job::class, $retrievedJob);
        $this->assertEquals($job->title, $retrievedJob->title);
    }
}

<?php

namespace Database\Factories;

use App\Models\Application;
use App\Models\Job;
use App\Models\Candidate;
use Illuminate\Database\Eloquent\Factories\Factory;

class ApplicationFactory extends Factory
{
    protected $model = Application::class;

    public function definition()
    {
        return [
            'job_id' => Job::factory(),
            'candidate_id' => Candidate::factory(),
            'application_date' => $this->faker->date()
        ];
    }
}

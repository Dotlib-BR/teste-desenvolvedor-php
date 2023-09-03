<?php

namespace Database\Factories;

use App\Models\Job;
use Illuminate\Database\Eloquent\Factories\Factory;

class JobFactory extends Factory
{
    protected $model = Job::class;

    public function definition()
    {
        return [
            'title' => $this->faker->jobTitle,
            'description' => $this->faker->paragraph,
            'type' => $this->faker->randomElement(['CLT', 'Pessoa Jurídica', 'Freelancer']),
            'status' => $this->faker->randomElement(['open', 'closed', 'paused'])
        ];
    }
}

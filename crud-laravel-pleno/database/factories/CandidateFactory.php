<?php

namespace Database\Factories;

use App\Models\Candidate;
use Illuminate\Database\Eloquent\Factories\Factory;

class CandidateFactory extends Factory
{
    protected $model = Candidate::class;

    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'email' => $this->faker->unique()->safeEmail,
            'experience' => $this->faker->text(200),
            'skills' => $this->faker->text(100),
            'availability' => $this->faker->text(50)
        ];
    }
}

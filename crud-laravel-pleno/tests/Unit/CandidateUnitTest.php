<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Candidate; // Changed to Candidate model

class CandidateUnitTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    /** @test */
    public function create_candidate()
    {
        $candidateData = [
            'name' => $this->faker->name,
            'email' => $this->faker->unique()->safeEmail,
            'experience' => 'Testando experiencia do profissional',
            'skills' => $this->faker->sentence,
            'availability' => $this->faker->randomElement(['Full-time', 'Part-time']),
        ];

        $candidate = Candidate::create($candidateData);

        $this->assertInstanceOf(Candidate::class, $candidate);
        $this->assertSame($candidateData['name'], $candidate->name);
        $this->assertSame($candidateData['experience'], $candidate->experience);
    }

    /** @test */
    public function update_candidate()
    {
        $candidate = Candidate::factory()->create();

        $newData = [
            'name' => $this->faker->name,
            'email' => $this->faker->unique()->safeEmail,
            'experience' => $this->faker->paragraph,
            'skills' => $this->faker->sentence,
            'availability' => $this->faker->randomElement(['Full-time', 'Part-time']),
        ];

        $candidate->update($newData);

        $this->assertSame($newData['name'], $candidate->name);
        $this->assertSame($newData['email'], $candidate->email);
    }
}

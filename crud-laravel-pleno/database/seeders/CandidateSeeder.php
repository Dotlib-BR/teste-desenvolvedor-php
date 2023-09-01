<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Candidate; 
use App\Models\Application; 

class CandidateSeeder extends Seeder
{
    public function run()
    {
        Candidate::factory()->count(20)->create()->each(function ($candidate) {
            $candidate->applications()->createMany(
                Application::factory()->count(3)->raw()
            );
        });
    }
}

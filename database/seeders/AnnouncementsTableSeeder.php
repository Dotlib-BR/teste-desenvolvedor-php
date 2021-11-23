<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Models\Company;
use App\Models\Announcement;

class AnnouncementsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $companies = Company::all();
        $enum = array('CLT', 'Legal person', 'Freelancer');
        for ($i=0; $i < sizeof($companies) ; $i++) {
            Announcement::create([
                    'company_id' => $companies[$i]->id,
                    'title' =>  Str::random(25),
                    'description' =>  Str::random(80),
                    'remuneration' => mt_rand(1000, 15000),
                    'active'=>rand(0, 1),
                    'vacancy_type' => $enum[rand(0, 2)],
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s')
            ]);
        }
    }
}

<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        try {
            DB::beginTransaction();

            User::create([
                'admin' => 1,
                'name' => 'admin',
                'email' => 'admin@admin.com',
                'cpf' => '11111111111',
                'password' => bcrypt('admin')
            ]);

            User::create([
                'name' => 'teste',
                'email' => 'teste@teste.com',
                'cpf' => '22222222222',
                'password' => bcrypt('senha123')
            ]);

            \App\Models\User::factory(10)->create();

            DB::commit();
        } catch (\Exception $ex) { DB::rollBack(); }
    }
}

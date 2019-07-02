<?php

use Illuminate\Database\Seeder;
use App\Models\User;

class UpdateDotlibUser extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::where('email', 'dotlib@dotlib.com')
            ->update([
                'role' => 'admin'
            ]);
    }
}

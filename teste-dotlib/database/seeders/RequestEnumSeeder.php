<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\RequestsEnum;
use Illuminate\Support\Facades\DB;

class RequestEnumSeeder extends Seeder
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

            DB::table('requests_enum')->insert([
                'status' => 'ABERTO'
            ]);

            DB::table('requests_enum')->insert([
                'status' => 'CANCELADO'
            ]);

            DB::table('requests_enum')->insert([
                'status' => 'PAGO'
            ]);

            DB::commit();
        } catch (\Exception $ex) { DB::rollBack(); }

    }
}

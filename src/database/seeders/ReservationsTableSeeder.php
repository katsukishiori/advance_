<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ReservationsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $param = [
            'name' => 'admin',
            'role' => 'admin',
            'created_at' => now(),
            'updated_at' => now(),

        ];

        DB::table('reservations')->insert($param);
    }
}

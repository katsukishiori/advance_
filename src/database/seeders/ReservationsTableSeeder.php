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
            'datetime' => \Carbon\Carbon::parse(\Faker\Factory::create()->dateTimeBetween('-1 month', '+1 month'))->toDateTimeString(),
            'reservation_count' => \Faker\Factory::create()->numberBetween(1, 10),
            'user_id' => '1',
            'shop_id' => '1',

        ];

        DB::table('reservations')->insert($param);
    }
}

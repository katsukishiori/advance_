<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserShopsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {


        $param = [
            'user_id' => 1,
            'shop_id' => 999,
            'role_id' => 1,
        ];
        DB::table('user_shops')->insert($param);

        $param = [
            'user_id' => 2,
            'shop_id' => 1,
            'role_id' => 2,
        ];
        DB::table('user_shops')->insert($param);

        $param = [
            'user_id' => 3,
            'shop_id' => 999,
            'role_id' => 3,
        ];
        DB::table('user_shops')->insert($param);
    }
}

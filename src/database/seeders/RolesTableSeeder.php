<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $param = [
            'name' => '管理者',
            'role' => 'admin',
        ];
        DB::table('roles')->insert($param);

        $param = [
            'name' => '店舗代表者',
            'role' => 'shopleader',
        ];
        DB::table('roles')->insert($param);

        $param = [
            'name' => '利用者',
            'role' => 'user',
        ];
        DB::table('roles')->insert($param);
    }
}

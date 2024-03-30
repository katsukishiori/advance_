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
            'role_name' => 'admin',
        ];
        DB::table('roles')->insert($param);

        $param = [
            'role_name' => 'shopleader',
        ];
        DB::table('roles')->insert($param);

        $param = [
            'role_name' => 'user',
        ];
        DB::table('roles')->insert($param);
    }
}

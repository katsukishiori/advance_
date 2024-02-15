<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = DB::table('users')->insertGetId([
            'name' => '太郎',
            'email' => 'tarou@email.com',
            'password' => bcrypt('11111111'),
        ]);
    }
}

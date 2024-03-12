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
        // 利用者のデータ挿入
        $paramUser = [
            'name' => '太郎',
            'email' => 'tarou@email.com',
            'password' => bcrypt('11111111'),
            'role_id' => 1, // 利用者のロール ID
        ];
        DB::table('users')->insert($paramUser);

        // 管理者のデータ挿入
        $paramAdmin = [
            'name' => '管理者',
            'email' => 'admin@email.com',
            'password' => bcrypt('11111111'),
            'role_id' => 10, // 管理者のロール ID
        ];
        DB::table('users')->insert($paramAdmin);

        // 店舗代表者のデータ挿入
        $paramShopLeader = [
            'name' => '店舗代表者',
            'email' => 'shopleader@email.com',
            'password' => bcrypt('11111111'),
            'role_id' => 20, // 店舗代表者のロール ID
        ];
        DB::table('users')->insert($paramShopLeader);
    }
}

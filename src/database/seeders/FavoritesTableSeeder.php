<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FavoritesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        // ダミーデータを挿入するコードをここに追加
        DB::table('favorites')->insert([
            'user_id' => 1,
            'shop_id' => 1,
        ]);
    }
}

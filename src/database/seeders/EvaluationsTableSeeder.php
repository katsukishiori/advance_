<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EvaluationsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        // テーブルをクリアして新しく開始
        DB::table('evaluations')->truncate();
        $param = [
            'id' => 1,
            'user_id' => 1,
            'shop_id' => 1,
            'nickname' => 'たろう',
            'comment' => 'お店の雰囲気も良く、とても美味しかったです。',
            'rating' => 4,
        ];
        DB::table('evaluations')->insert($param);
    }
}

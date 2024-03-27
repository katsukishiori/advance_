<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserShopsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_shops', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained();
            $table->foreignId('shop_id')->constrained();
            $table->foreignId('role_id')->constrained('roles'); // rolesテーブルへの外部キー制約を追加
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('user_shops', function (Blueprint $table) {
            // 外部キー制約の削除
            $table->dropForeign(['user_id']);
            $table->dropForeign(['shop_id']);
            $table->dropForeign(['role_id']);
        });

        Schema::dropIfExists('user_shops');
    }
}

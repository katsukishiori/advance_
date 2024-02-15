<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prefecture extends Model
{
    protected $fillable = ['prefecture_name']; // 外部から設定可能なフィールド

    // PrefectureモデルとShopモデルのリレーション
    public function shops()
    {
        // return $this->hasMany(Shop::class, 'prefecture_id', 'id');
        return $this->hasMany(Shop::class);
    }
}

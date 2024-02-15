<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Genre extends Model
{
    protected $fillable = ['genre_name']; // 外部から設定可能なフィールド

    // GenreモデルとShopモデルのリレーション
    public function shops()
    {
        // return $this->hasMany(Shop::class, 'genre_id', 'id');
        return $this->hasMany(Shop::class);
    }

}

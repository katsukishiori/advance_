<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Prefecture;
use App\Models\Genre;

class Shop extends Model
{
    protected $fillable = ['prefecture_id', 'genre_id', 'shop_name', 'shop_overview', 'shop_image']; // 外部から設定可能なフィールド

    // Prefectureモデルとのリレーション
    public function prefecture()
    {
        // return $this->hasOne(Prefecture::class, 'prefecture_id', 'id');
        return $this->belongsTo(Prefecture::class, 'prefecture_id');
    }

    // Genreモデルとのリレーション
    public function genre()
    {
        // return $this->hasOne(Genre::class, 'genre_id', 'id');
        return $this->belongsTo(Genre::class, 'genre_id');
    }

    public function reservations()
    {
        return $this->belongsToMany(Reservation::class, 'shop_reservation', 'shop_id', 'reservation_id');
    }




    public function getPrefectures()
    {
        return Prefecture::all();
    }

    public function getGenres()
    {
        return Genre::all();
    }

    //検索機能
    public function scopePrefectureSearch($query, $prefecture_id)
    {
        if (!empty($prefecture_id)) {
            $query->where('prefecture_id', $prefecture_id);
        }
    }

    public function scopeGenreSearch($query, $genre_id)
    {
        if (!empty($genre_id)) {
            $query->where('genre_id', $genre_id);
        }
    }

    public function scopeKeywordSearch($query, $keyword)
    {
        if (!empty($keyword)) {
            $query->where('content', 'like', '%' . $keyword . '%');
        }
    }
}

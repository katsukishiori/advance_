<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Http\Request;
use App\Models\Prefecture;
use App\Models\Genre;
use Illuminate\Support\Str;



class Shop extends Model
{
    protected $fillable = ['prefecture_id', 'genre_id', 'shop_name', 'shop_overview', 'shop_image', 'slug'];



    // ミューテータを定義して自動的にslugを生成
    public function setSlugAttribute($value)
    {
        $this->attributes['slug'] = Str::slug($value);
    }

    // Eloquentのcreatingイベントを使用してslugを自動生成
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($shop) {
            $shop->slug = Str::slug($shop->shop_name);
        });
    }





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

    public function search(Request $request)
    {

        // フォームからキーワードを取得
        $keyword = $request->input('keyword');

        // Eloquentクエリで部分一致検索を行う（店名に対して）
        $results = Shop::keywordSearch($keyword)->get();

        // 検索結果をビューに渡す
        return view('shop', ['results' => $results]);
    }


    public function scopeKeywordSearch($query, $keyword)
    {
        return $query->where('shop_name', 'like', '%' . $keyword . '%');
    }




    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function likes()
    {
        return $this->hasMany('App\Models\Favorite');
    }

    public function evaluations()
    {
        return $this->hasMany(Evaluation::class, 'shop_id');
    }



    // お気に入りのハートの色を保持
    protected $appends = ['is_favorite'];

    public function getIsFavoriteAttribute()
    {
        // お気に入りの状態を取得するロジックを実装
        // 例えば、Favorites テーブルに対してのリレーションを使ったりする
        return $this->favorites()->where('user_id', auth()->id())->exists();
    }

    public function favorites()
    {
        return $this->hasMany(Favorite::class);
    }

    public function shopleader()
    {
        return $this->hasMany(Shopleader::class);
    }
}

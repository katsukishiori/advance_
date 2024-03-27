<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Http\Request;
use App\Models\Prefecture;
use App\Models\Genre;



class Shop extends Model
{
    protected $fillable = ['prefecture_id', 'genre_id', 'shop_name', 'shop_overview', 'shop_image'];

    // Prefectureモデルとのリレーション
    public function prefecture()
    {
        return $this->belongsTo(Prefecture::class, 'prefecture_id');
    }

    // Genreモデルとのリレーション
    public function genre()
    {
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




    public function users()
    {
        return $this->belongsToMany(User::class, 'user_shops')->withPivot('role_id');
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

}

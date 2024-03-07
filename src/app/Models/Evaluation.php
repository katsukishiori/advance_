<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Evaluation extends Model
{
    use HasFactory;

    // protected $table = 'evaluations';
    // protected $fillable = ['user_id', 'shop_id', 'nickname', 'rating', 'comment', 'photo_path'];

    public function showEvaluations()
    {
        // evaluations テーブルから nickname, comment, rating のデータを取得
        $evaluations = Evaluation::select('nickname', 'comment', 'rating')->get();

        // ビューにデータを渡す
        return view('evaluations.show', ['evaluations' => $evaluations]);
    }

    // ユーザーとのリレーション
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // ショップとのリレーション
    public function shop()
    {
        return $this->belongsTo(Shop::class, 'shop_id');
    }
}

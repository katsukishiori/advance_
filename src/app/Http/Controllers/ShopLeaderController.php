<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reservation;

class ShopLeaderController extends Controller
{
    public function index(Request $request)
    {
        // ユーザーがログインしているか確認
        if (auth()->check()) {
            // ユーザーのロールを取得
            $userRole = auth()->user()->role_id;

            // ロールが店舗代表者（2）であるか確認
            if ($userRole == 2) {
                // 店舗代表者の場合の処理
                return view('shopleader');
            } else {
                // 店舗代表者でない場合はリダイレクトなどの処理
                return redirect('/')->with('error', '権限がありません。');
            }
        } else {
            // ログインしていない場合はログインページにリダイレクト
            return redirect('/login');
        }
    }
}

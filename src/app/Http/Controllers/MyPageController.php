<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Reservation;
use App\Models\Favorite;
use App\Models\Shop;
use App\Models\Prefecture;



class MyPageController extends Controller
{
    // 予約データ追加
    public function add()
    {
        $reservations = Reservation::with('shops')->get();
        return view('mypage', ['reservations' => $reservations]);
    }


    //削除機能
    public function remove($id)
    {
        Reservation::find($id)->delete();
        // 削除後のリダイレクトなどが必要であれば追加する
        return redirect()->route('mypage');
    }

    //お気に入り情報取得
    public function showFavorites()
    {
        $favorites = Favorite::with('shops')->get();
        return view('my_page', compact('shops'));
    }

    public function index()
    {
        if (Auth::check()) {
            // ログインユーザーの予約情報を取得
            $user = Auth::user();
            $reservations = $user->reservations()->with('shop')->get();

            // ログインユーザーのお気に入りの店舗情報を取得
            $favorites = $user->favorites()->with('shop')->get();
            $shops = $favorites->pluck('shop');

            $prefectures = Prefecture::all();

            return view('mypage', compact('user', 'favorites', 'reservations', 'shops'));
        } else {
            // ユーザーがログインしていない場合の処理
            return redirect()->route('login');
        }
    }

    public function like(Request $request)
    {
        $shops = Shop::all();
        return view('shop', ['shops' => $shops]);
    }


    //予約更新
    public function update(Request $request, $id)
    {
        // 認証確認
        if (auth()->check()) {
            $userId = auth()->id();

            // 特定の予約情報を取得
            $reservation = Reservation::find($id);

            // 予約情報が存在し、かつログインユーザーに属しているか確認
            if ($reservation && $reservation->user_id == $userId) {
                // 予約情報を更新
                $reservation->update([
                    'datetime' => $request->input('date') . ' ' . $request->input('time'),
                    'reservation_count' => $request->input('reservation_count'),
                ]);

                // お気に入り店舗情報は更新しない

                return redirect()->route('mypage')->with('success', '予約情報が更新されました');
            } else {
                // ログインユーザーに属していない場合の処理
                return redirect()->back()->with('error', '指定された予約情報は存在しないか、アクセス権がありません。');
            }
        } else {
            // ログインしていない場合の処理
            return redirect()->route('login');
        }
    }
}

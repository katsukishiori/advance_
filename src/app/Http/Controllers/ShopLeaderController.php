<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Reservation;
use App\Http\Requests\CreateShopleadersRequest;
use App\Models\ShopLeader;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;


class ShopLeaderController extends Controller
{
    public function index()
    {
        $reservations = Reservation::all();

        return view('confirm_reservation', compact('reservations'));
    }

    public function create(CreateShopleadersRequest $request)
    {
        $validatedData = $request->validated();

        // 現在ログインしているユーザーの ID を取得
        $userId = Auth::id();
        // フォームから送信された shop_id を取得
        $shopId = $request->input('shop_name');

        $roleId = 2;

        // ShopLeader モデルを作成
        ShopLeader::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'password' => Hash::make($validatedData['password']),
            'shop_id' => $shopId, // フォームから送信された shop_id を使用
            'user_id' => $userId,
            'role_id' => $roleId,
        ]);

        Session::flash('success_message', '登録が完了しました。');


        // リダイレクトなどの適切な処理を行う
        return redirect('/create_shopleaders');
    }

    public function dashboard()
    {
        $reservations = Reservation::all();

        // ビューに変数 $reservations を渡して表示する
        return view('confirm_reservation', ['reservations' => $reservations]);
    }
}

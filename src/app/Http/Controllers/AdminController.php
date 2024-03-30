<?php

namespace App\Http\Controllers;

use App\Models\Shop;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\CreateShopleadersRequest;
use App\Models\UserShop;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
class AdminController extends Controller
{
    public function index()
    {
        $shops = Shop::all();

        return view('create_shopleaders', ['shops' => $shops]);
    }

    public function dashboard()
    {
        return view('create_shopleaders.dashboard');
    }

    public function create(CreateShopleadersRequest $request)
    {
        $validatedData = $request->validated();

        // 現在ログインしているユーザーの ID を取得
        $userId = Auth::id();

        // フォームから送信された shop_id を取得
        $shopId = $request->input('shop_name');

        $roleId = 2;

        // User モデルの create() メソッドを使用してユーザーを保存
        $user = User::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'password' => Hash::make($validatedData['password']),
        ]);

        // user_shops テーブルにデータを保存する
        UserShop::create([
            'user_id' => $user->id,
            'shop_id' => $shopId,
            'role_id' => $roleId,
        ]);

        // リダイレクトなどの適切な処理を行う
        return redirect('/create_shopleaders')->with('success_message', '登録が完了しました。');
    }
}

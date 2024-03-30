<?php

namespace App\Http\Controllers;

use Illuminate\Auth\Events\Registered;
use App\Http\Requests\AuthorRequest;
use App\Http\Requests\LoginRequest;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\UserShop;



class AuthController extends Controller
{
    public function store(AuthorRequest $request)
    {
        // デフォルトのショップIDと役割IDを定義
        $defaultShopId = 999;
        $defaultRoleId = 3;

        // 既存のメールアドレスを持つユーザーが存在しないことを確認
        $existingUser = User::where('email', $request->input('email'))->first();
        if ($existingUser) {
            // 既に登録されたメールアドレスの場合はエラーを返す
            return redirect()->back()->withErrors(['email' => 'このメールアドレスは既に登録されています。']);
        }

        // ユーザーを作成
        $user = User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')),
        ]);

        // ユーザーショップ情報を作成
        $user->shops()->attach($defaultShopId, ['role_id' => $defaultRoleId]);

        // 新しいユーザーが作成されたら thanks ページにリダイレクト
        return redirect('thanks');
    }

    public function login(LoginRequest $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            // ログインしたユーザーのIDを取得
            $userId = Auth::id();

            // ユーザーショップを取得
            $userShop = UserShop::where('user_id', $userId)->first();

            // ユーザーショップからrole_idを取得
            $role_id = $userShop->role_id;

        } else {
            // ログイン失敗時の処理
            return redirect('/login')->with('error', 'メールアドレスまたはパスワードが間違っています。');
        }
    }
}

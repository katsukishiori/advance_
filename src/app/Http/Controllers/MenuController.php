<?php

namespace App\Http\Controllers;


use Illuminate\Support\Facades\Auth;

class MenuController extends Controller
{
    public function index()
    {
        // 認証されたユーザーの情報を取得
        $user = Auth::user();

        // ユーザーが認証されているかどうかを確認
        if ($user) {
            // ユーザーが認証されている場合、role_id を取得
            $role_id = $user->role_id;

            // $role_id を使用して処理を行う
            return view('menu', ['role_id' => $role_id]);
        } else {
            // ユーザーが認証されていない場合の処理
            // 例えば、ログインページにリダイレクトするなど
            return redirect()->route('login');
        }
    }
}

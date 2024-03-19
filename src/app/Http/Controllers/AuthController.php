<?php

namespace App\Http\Controllers;

use App\Http\Requests\AuthorRequest;
use App\Http\Requests\LoginRequest;
use App\Models\User;
use Illuminate\Support\Facades\Hash;


class AuthController extends Controller
{
    public function login(LoginRequest $request)
    {
        // フォームリクエストでバリデーションを行う
        $validatedData = $request->validated();

        // if (auth()->guard('shopleaders')->attempt(['email' => $validatedData['email'], 'password' => $validatedData['password']])) {
        //     // Shopleadersテーブルのユーザーがログインした場合の処理
        //     return redirect()->route('shopleader_dashboard_route_name');
        // }
        {
            // ユーザーがログインしている場合
            $user = auth()->user();

            if ($user && $user->isAdmin()) {
                return redirect()->route('create_shopleaders.dashboard');
            } elseif ($user && $user->isShopLeader()) {
                return redirect()->route('confirm_reservation.dashboard');
            }

            $credentials = $request->only('email', 'password');
            if (auth()->attempt($credentials)) {
                // ユーザーがログインしている場合
                return redirect()->intended('/');
            } else {
                // ユーザーがログインしていない場合
                return redirect('/login')->with('error', 'メールアドレスまたはパスワードが間違っています。');
            }
        }

        // ユーザーがログインしていない場合
        return redirect('/login')->with('error', '無効なメールアドレスまたはパスワードです。');
    }





    public function store(AuthorRequest $request)
    {
        // バリデーションが成功した場合のみ処理を続行
        $validatedData = $request->validated();

        // ユーザーが既に存在するか確認
        $userExists = User::where('email', $validatedData['email'])->exists();

        if ($userExists) {
            // ユーザーが既に存在する場合はエラーを返す
            return redirect()->back()->withErrors(['email' => 'このメールアドレスは既に登録されています。']);
        }

        // ユーザーが存在しない場合は新しいユーザーを作成
        $user = User::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'password' => Hash::make($validatedData['password']),
        ]);

        // 新しいユーザーが作成されたら thanks ページにリダイレクト
        return redirect('thanks');
    }
}

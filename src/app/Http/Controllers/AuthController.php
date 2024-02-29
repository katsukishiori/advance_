<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\AuthorRequest;
use App\Models\User;
use Illuminate\Support\Facades\Hash; // Hashクラスを使用するために追加


class AuthController extends Controller
{
    public function index()
    {
        return view('shop');
    }

    public function login(AuthorRequest $request)
    {
        // バリデーションが成功した場合のみ処理を続行
        $validatedData = $request->validated();

        $user = User::all([
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')),
        ]);

        // ユーザーをログインさせる
        User::login($user);

        return redirect('/shop');
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

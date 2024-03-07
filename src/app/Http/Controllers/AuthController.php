<?php

namespace App\Http\Controllers;

use App\Http\Requests\AuthorRequest;
use App\Models\User;
use Illuminate\Support\Facades\Hash;


class AuthController extends Controller
{
    public function index()
    {
        return view('shop');
    }

    public function login(AuthorRequest $request)
    {
        // バリデーション
        $validatedData = $request->validated();

        // メールアドレスでユーザーを取得
        $user = User::where('email', $validatedData['email'])->first();

        // ユーザーが存在し、パスワードが正しいかどうかを確認
        if ($user && Hash::check($validatedData['password'], $user->password)) {
            // ユーザーをログインさせる
            User::login($user);

            // セッションから元のURLを取得
            $redirectUrl = session('redirect_url', '/');

            // セッションから元のURLを削除
            session()->forget('redirect_url');

            // 元のページにリダイレクト
            return redirect($redirectUrl)->with('success', 'ログインしました。');
        }

        // 認証に失敗した場合、エラーメッセージとともに戻る
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

<?php

namespace App\Http\Controllers;

use Illuminate\Auth\Events\Registered;
use App\Http\Requests\AuthorRequest;
use App\Http\Requests\LoginRequest;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\UserShop;

use Illuminate\Support\Facades\Mail;
use App\Mail\AnnouncementMail;

use Illuminate\Auth\Notifications\VerifyEmail;



class AuthController extends Controller
{
    public function login(LoginRequest $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            // ログイン成功時の処理


            // ログインしたユーザーのIDを取得
            $userId = Auth::id();

            // ユーザーショップを取得
            $userShop = UserShop::where('user_id', $userId)->first();

            // ユーザーショップからrole_idを取得
            $role_id = $userShop->role_id;


            // role_idに基づいてリダイレクト先を設定
            switch ($role_id) {
                case 1:
                    // 管理者の場合の処理
                    return redirect()->route('admin.dashboard');
                    break;
                case 2:
                    // ショップリーダーの場合の処理
                    return redirect()->route('confirm_reservation');
                    break;
                    // その他の役割に対する処理を追加する場合はここに追記
                default:
                    // デフォルトのリダイレクト先を設定
                    return redirect('/');
                    break;
            }
        } else {
            // ログイン失敗時の処理
            return redirect('/login')->with('error', 'メールアドレスまたはパスワードが間違っています。');
        }
    }



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

        event(new Registered($user)); //メール

        // ユーザーショップ情報を作成
        $user->shops()->attach($defaultShopId, ['role_id' => $defaultRoleId]);

        // 本人確認メールを送信
        $user->sendEmailVerificationNotification();

        Mail::raw('test mail', function ($message) {
            $message->to('test@example.com')
                ->subject('test');
        });

        // 新しいユーザーが作成されたら thanks ページにリダイレクト
        return redirect('thanks');
    }

    public function showRegistrationForm()
    {
        return view('auth.register');
    }
}

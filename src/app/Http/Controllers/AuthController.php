<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\AuthorRequest;
use App\Models\User;
use Illuminate\Support\Facades\Hash;


class AuthController extends Controller
{
    // public function index(Request $request)
    // {
    //     $user = $request->user();

    //     if ($user->isAdmin()) {
    //         return view('admin');
    //     } elseif ($user->isShopLeader()) {
    //         return view('shopleader');
    //     } else {
    //         return view('shop');
    //     }
    // }

    public function login(AuthorRequest $request)
    {
        $validatedData = $request->validated();

        $user = User::where('email', $validatedData['email'])->first();

        if ($user && Hash::check($validatedData['password'], $user->password)) {
            auth()->login($user);

            $redirectUrl = session('redirect_url', '/');

            session()->forget('redirect_url');

            // role_id をセッションに保存
            session(['role_id' => $user->role_id]);

            return redirect($redirectUrl)->with('success', 'ログインしました。');
        }

        return redirect('/login')->with('error', '無効なメールアドレスまたはパスワードです。');
    }

    <?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\AuthorRequest;
use App\Models\User;
use Illuminate\Support\Facades\Hash;


class AuthController extends Controller
{
    public function index(Request $request)
{
    // ユーザーがログインしているか確認
    if (auth()->check()) {
        // ユーザーのロールを取得
        $userRole = auth()->user()->role_id;

        // ロールに応じてリダイレクト先を決定
        switch ($userRole) {
            case 10: // 管理者の場合
                return redirect('/admin');
                break;
            case 20: // 店舗代表者の場合
                return redirect('/shopleader');
                break;
            case 1: // 一般ユーザーの場合
                return view('shop');
                break;
            default:
                // 上記以外の場合は権限がない旨のメッセージを表示
                return redirect('/')->with('error', '権限がありません。');
        }
    } else {
        // ログインしていない場合はログインページにリダイレクト
        return redirect('/login');
    }
}

    public function login(AuthorRequest $request)
    {
        $validatedData = $request->validated();

        $user = User::where('email', $validatedData['email'])->first();

        if ($user && Hash::check($validatedData['password'], $user->password)) {
            auth()->login($user);

            $redirectUrl = session('redirect_url', '/');

            session()->forget('redirect_url');

            // ログイン処理の一部

            auth()->login($user);

            // role_id をセッションに保存
            session(['role_id' => $user->role_id]);

            return redirect($redirectUrl)->with('success', 'ログインしました。');
        }

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

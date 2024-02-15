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


    // public function index()
    // {
    //     $users = User::all();
    //     return view('auth.register', ['users' => $users]);
    // }





    // public function create()
    // {
    //     return view('auth.register');
    // }

    // public function create(AuthorRequest $request)
    // {
    //     $form = $request->all();
    //     User::create($form);
    //     return redirect('/');
    // }

    public function login(AuthorRequest $request)
    {

        // バリデーションが成功した場合のみ処理を続行
        $validatedData = $request->validated();

        $user = User::create([
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

        $user = User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')),
        ]);

        return redirect('/thanks');
    }

    // public function create()
    // {
    //     return view('auth.register');
    // }

    // public function store(Request $request)
    // {
    //     $user = User::create([
    //         "name" => $request->input("name"),
    //         "email" => $request->input("email"),
    //         "password" => Hash::make($request->input("password")),
    //     ]);
    //     //$users = $request->only(['name', 'email', 'password', 'password_confirmation']);
    //     // "password"=>Hash::make($req->input("password")),
    //     //User::create($user);

    //     return redirect('/login');
}

















    // public function add()
    // {
    //     return view('shop');
    // }

    // public function create(Request $request)
    // {
    //     $form = $request->all();
    //     User::create($form);
    //     return redirect('/');
    // }

    // public function index()
    // {
    //     $users = User::all();
    //     return view('shop', ['users' => $users]);
    // }

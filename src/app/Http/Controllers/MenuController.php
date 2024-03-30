<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class MenuController extends Controller
{
    public function index()
    {
        // 認証されたユーザーの情報を取得
        $user = Auth::user();


        return view('menu');
    }
}

<?php

namespace App\Http\Middleware;


use Closure;
use Illuminate\Http\Request;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */

    // public function handle(Request $request, Closure $next)
    // {

    //     // ユーザーがログインしていない場合はログインページにリダイレクト
    //     if (!auth()->check()) {
    //         return redirect()->route('login');
    //     }

    //     if (auth()->user()->role_id == 1) {
    //         return $next($request);
    //     }

    //     // ロールが10でない場合はリダイレクトなどの処理
    //     return redirect('/')->with('error', '権限がありません');
    // }

    public function handle(Request $request, Closure $next)
    {
        if (!$request->user() || $request->user()->role_id !== 1) {
            return redirect('/');
        }

        return $next($request);
    }
}

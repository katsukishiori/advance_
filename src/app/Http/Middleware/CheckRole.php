<?php

namespace App\Http\Middleware;



use Closure;
use Illuminate\Http\Request;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @param  int  $role
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle($request, Closure $next, $role)
    {
        // ユーザーが認証されているか確認
        if (!auth()->check()) {
            return redirect('/login');
        }

        // ユーザーのロール
        $userRole = auth()->user()->role_id;

        // ロールの確認ロジック
        if ($userRole == $role) {
            return $next($request);
        } else {
            // 一致しないロールの場合はログインページにリダイレクト
            return redirect('/login');
        }
    }
}


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
        $userRole = $request->user()->role_id;

        // role_idが1または2の場合、アクセスを許可
        if ($userRole == $role || $userRole == 1 || $userRole == 2) {
            return $next($request);
        }

        // 上記条件に当てはまらない場合、403エラーを返す
        abort(403, 'Unauthorized');
    }
}

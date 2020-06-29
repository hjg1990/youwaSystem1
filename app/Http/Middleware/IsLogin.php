<?php

namespace App\Http\Middleware;

use Closure;

class IsLogin
{
    /**
     * Handle an incoming request.
     *是否登录的验证中间件  不登录就退出到
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {

        /**
         * 获取session中的用吗
         */
        if (session('supervisor')) {
            return $next($request);
        } else {
            return redirect('admin/login')->with('errors', '请不要另辟蹊径！');
        }

    }
}

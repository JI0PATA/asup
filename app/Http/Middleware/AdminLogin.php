<?php

namespace App\Http\Middleware;

use Closure;

class AdminLogin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {

        if ($request->login === 'admin' && $request->password === 'admin') {
            $request->session()->put('admin', '1');
            createMsg(1, 'Добро пожаловать, Главный инженер!');
            return redirect()->route('admin.index');
        }

        return $next($request);
    }
}

<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        if (Auth::guard($guard)->check()) {
            createMsg(0, 'Доступна только неавторизованным пользователям');
            return redirect()->route('home');
        } else if (session()->get('admin') === '1') {
            createMsg(0, 'Доступна только неавторизованным пользователям');
            return redirect()->route('admin.index');
        }

        return $next($request);
    }
}

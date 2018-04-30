<?php

namespace App\Http\Middleware;

use Closure;

class AdminPanel
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
        if ($request->session()->get('admin') !== '1') {
            createMsg(0, 'У вас недостаточно прав!');
            return redirect()->route('login');
        }

        return $next($request);
    }
}

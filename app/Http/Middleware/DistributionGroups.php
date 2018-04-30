<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class DistributionGroups
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

        if ($request->route()->getPrefix() === '/engineer' && Auth::user()->group_id === 1) {
            createMsg(0, 'У вас нет доступа!');
            return redirect()->route('home');
        } else if ($request->route()->getPrefix() === '/' && Auth::user()->group_id === 2) {
            createMsg(0, 'У вас нет доступа!');
            return redirect()->route('engineer.index');
        }

        return $next($request);
    }
}

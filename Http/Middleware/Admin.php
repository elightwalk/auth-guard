<?php

namespace Elightwalk\AuthGuard\Http\Middleware;

use Closure;
use Elightwalk\Modules\Facades\Auth;
use Elightwalk\AuthGuard\Providers\RouteServiceProvider;

class Admin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = 'admin')
    {

        if (Auth::guard($guard)->check()) {
            if ($request->is('admin') || $request->is('admin/*')) {
                return $next($request);
            }
        }
        return redirect(RouteServiceProvider::LOGINADMIN);
    }
}

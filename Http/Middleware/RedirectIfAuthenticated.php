<?php

namespace Elightwalk\AuthGuard\Http\Middleware;

use Elightwalk\AuthGuard\Providers\RouteServiceProvider;
use Closure;
use Elightwalk\Modules\Facades\Auth;

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
        if (Auth::guard('admin')->check()) {
            return redirect(RouteServiceProvider::ADMIN);
        }else if (Auth::guard('customer')->check()) {
            return redirect(RouteServiceProvider::CUSTOMER);
        }
        return $next($request);
    }
}

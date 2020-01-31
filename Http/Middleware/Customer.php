<?php

namespace Elightwalk\AuthGuard\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Elightwalk\AuthGuard\Providers\RouteServiceProvider;

class Customer
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = 'customer')
    {
        if (Auth::guard($guard)->check()) {
            if ($request->is('customer') || $request->is('customer/*')) {
                return $next($request);
            }
        }

        return redirect(RouteServiceProvider::LOGINCUSTOMER);
    }
}

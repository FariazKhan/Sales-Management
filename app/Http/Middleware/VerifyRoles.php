<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;

class VerifyRoles
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

        if (Auth::user()->role == 1)
        {
            View::share('role', 'super_admin');
        }
        elseif (Auth::user()->role == 2)
        {
            View::share('role', 'sub_admin');
        }
        elseif (Auth::user()->role == 3)
        {
            View::share('role', 'user');
        }
        elseif (Auth::user()->role == null)
        {
            View::share('role', 'null');
        }
        // View::share('name', null);
        return $next($request);
    }
}

<?php

namespace App\Http\Middleware;

use App\FetchRoles;
use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;

class GetRoles
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
        $roles = FetchRoles::where('role_id', '=', Auth::user()->role)->get()->first();
        View::share('role', $roles);
        return $next($request);
    }
}

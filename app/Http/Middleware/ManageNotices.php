<?php

namespace App\Http\Middleware;

use Closure;
use App\Notice;
use Illuminate\Support\Facades\View;

class ManageNotices
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
        $dat = Notice::all();
        $countNotice = Notice::all()->count();
        View::share('notices', $dat);
        View::share('countNotice',$countNotice);
        return $next($request);
    }
}

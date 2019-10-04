<?php

namespace App\Http\Middleware;

use Carbon\Carbon;
use Closure;
use App\Notice;

class DeleteScheduleWise
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
        $old = Notice::all();
        $date = new Carbon();
        foreach ($old as $dat)
        {
            if ($date > $dat->expdate)
            {
                Notice::find($dat->id)->delete();
            }
        }
        return $next($request);
    }
}

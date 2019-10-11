<?php

namespace App\Http\Middleware;

use App\Discount;
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
        $date = new Carbon();

        // Checking for notices
        $notice = Notice::all();
        foreach ($notice as $dat)
        {
            if ($date > $dat->expdate)
            {
                Notice::find($dat->id)->delete();
            }
        }

        // Checking for discounts
        $discount = Discount::all();
        foreach ($discount as $dat)
        {
            if ($date > $dat->expire_date)
            {
                Discount::find($dat->id)->delete();
            }
        }
        return $next($request);
    }
}

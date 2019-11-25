<?php

namespace App\Http\Middleware;

use Closure;
use App\Sales;
use Illuminate\Support\Facades\View;

class CheckOutOfStockProducts
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
        $out_of_stock = Sales::where("available", "<", 1)->count();
        View::share('out_of_stock', $out_of_stock);
        return $next($request);
    }
}

<?php

namespace App\Http\Middleware;

use Closure;

use App\Order;

class CheckOrderStatus
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
        //check if order is editable
        if(Order::findOrFail($request->id)->editable()){
            return $next($request);
        }

        //if not
        return back()
                 ->withErrors(' Order non-editable.');

    }
}

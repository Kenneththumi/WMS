<?php

namespace App\Http\Middleware;

use Closure;

use App\Order;

class AssignOrder
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
        //check if order is assignable
        if(Order::findOrFail($request->id)->assignable()){
            return $next($request);
        }

        //if not
        return back()
            ->withErrors(' Order not re-assignable.');
    }
}

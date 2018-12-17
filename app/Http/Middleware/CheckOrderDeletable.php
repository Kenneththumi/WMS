<?php

namespace App\Http\Middleware;

use Closure;

class CheckOrderDeletable
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
        if(Order::findOrFail($request->id)->deletable()){
            return $next($request);
        }

        //if not
        return back()
            ->withErrors(' Order-'.$request->id.' cannot be deleted at is current state.');
    }
}

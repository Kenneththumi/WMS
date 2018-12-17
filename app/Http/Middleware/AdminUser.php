<?php

namespace App\Http\Middleware;

use Closure;

class AdminUser
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
        if( auth()->user()->isAdmin() || auth()->user()->isSuperAdmin() ){
            return $next($request);
        }

        return back()
                    ->withErrors(' Insufficient Permission.');
    }
}

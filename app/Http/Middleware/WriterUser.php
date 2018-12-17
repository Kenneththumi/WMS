<?php

namespace App\Http\Middleware;

use Closure;

class WriterUser
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
        if(auth()->user()->isWriter()){
            return $next($request);
        }
        return back()
                 ->withErrors(' Insufficient Permission.');
    }
}

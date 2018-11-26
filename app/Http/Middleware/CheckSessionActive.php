<?php

namespace App\Http\Middleware;

use Closure;

class CheckSessionActive
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
        if (session('sessionActive') != null) {
            return $next($request);
        }   

        return redirect()->route('welcome.index');
    }
}

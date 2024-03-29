<?php

namespace App\Http\Middleware;

use Closure;

class NoCacheMiddleware
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
        $reponse =  $next($request);
        $reponse->header('Cache-Control','no-cache,no-store,max-age=0,must-revalidate');

        return $reponse;
    }
}

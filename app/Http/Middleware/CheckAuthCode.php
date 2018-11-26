<?php

namespace App\Http\Middleware;

use Closure;

class CheckAuthCode
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
        if(session('sessionActive') != null){
            if (session('codeAuth')) {
                return $next($request);     
            }
            return redirect()->route('auth.index');
        }

        return redirect()->route('welcome.index');
    }
}

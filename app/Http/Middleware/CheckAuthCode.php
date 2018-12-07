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
        if(session('student') != null){
            if (empty($request['c']) || (session('student')->idcodes != $request['c']) ) {
                return redirect()->route('publish.show',getPublishUrl());
            }
            if (session('student')->idcodes == $request['c']) {
                return $next($request);     
            }
            return redirect()->route('auth.index');
        }

        return redirect()->route('welcome.index');
    }
}

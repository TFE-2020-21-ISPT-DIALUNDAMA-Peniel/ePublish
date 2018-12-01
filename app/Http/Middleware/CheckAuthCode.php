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
        // dd($request);
        if(session('student') != null){
            if (empty($request['c']) || (session('student')->code!= $request['c']) ) {
                return redirect()->route('publish.show',session('student')->nom.'?c='.session('student')->code);
            }
            if (session('student')->code== $request['c']) {
                return $next($request);     
            }
            return redirect()->route('auth.index');
        }

        return redirect()->route('welcome.index');
    }
}

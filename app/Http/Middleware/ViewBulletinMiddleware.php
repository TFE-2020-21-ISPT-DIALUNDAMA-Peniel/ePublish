<?php

namespace App\Http\Middleware;

use Closure;

class ViewBulletinMiddleware
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
        if (!empty($_SERVER['HTTP_REFERER']) && !empty(session('student'))) {
            if ($_SERVER['HTTP_REFERER'] == route('publish.show',getPublishUrl())) {
                    return $next($request);
            }
        }
        return abort(401);

    }
}

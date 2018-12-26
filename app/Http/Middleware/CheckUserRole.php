<?php

namespace App\Http\Middleware;

use Closure;

class CheckUserRole
{
    /**
     * Rédirige l'utilisateur connecté par rapport à son role
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (Auth()->check()) {
            
            setUserSession();//initialisation des informations suplémentaires de l'utilisateur
            $prefixe = getPrefixeRoute($request->server());
            $idusers_roles= $request->user()->idusers_roles;
            $userRole = session('user')['role'];

            if($prefixe !== $userRole ) {
                return redirect(redirectToDashboard());
            }
            
        }

        return $next($request);
    }
}

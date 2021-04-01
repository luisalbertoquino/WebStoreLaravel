<?php

namespace App\Http\Middleware;

use Closure;

class PermisoMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, ...$permisos)
    {
        foreach($permisos as $permiso){
            if(auth()->user()->hasPermission($permiso)){
                return $next($request); 
            }
            if(auth()->user()->hasRole($permiso)){
                return $next($request); 
            } 
        }
    
        abort(401, "User can't perform this actions");
         
    }
}

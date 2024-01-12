<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AuthentificationPropre
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, $role)
    {
		// Check if the provided role matches the session role
		if($role===session('role')){
			return $next($request);
		}

		// Additional checks for specific role combinations with the same rights
		if($role===2 and session('role')===3){
			return $next($request);
		}	

		if($role===2 and session('role')===4){
			return $next($request);
		}

		if($role===3 and session('role')===2){
			return $next($request);
		}	

		if($role===3 and session('role')===4){
			return $next($request);
		}

		if($role===4 and session('role')===2){
			return $next($request);
		}	

		if($role===4 and session('role')===3){
			return $next($request);
		}			
        
		// If none of the conditions match, redirect to the default route
		return redirect('/');
    }
}

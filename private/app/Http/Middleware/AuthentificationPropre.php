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
		if($role===session('role')){
			return $next($request);
		}	
        //return Response()->view('welcome');
		return redirect('/');
    }
}

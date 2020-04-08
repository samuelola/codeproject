<?php

namespace App\Http\Middleware;

use Closure;

use Illuminate\Support\Facades\Auth;

class Admin
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
        
        // this is to check if the user is logged in
        if(Auth::check()){
           
            // this is check for the user if he/she is an admin

            if(Auth::user()->isAdmin()){

                 return $next($request); // this means everything when through then go to the next application
            }
        }


        return redirect('/');


        
    }
}

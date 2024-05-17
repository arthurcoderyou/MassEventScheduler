<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Auth;

class UserMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        //Check if the Authenticated user_type is admin
        if (!empty(Auth::check())) {
            if(Auth::check()){
                if(Auth::user()->role == 'user'){
                    return $next($request);
                }else{
                    Auth::logout();
                    return redirect()->route("account.login");
                }
            }
            
        }else {
            Auth::logout();
            return redirect()->route('account.login');
        }

        // return $next($request);
    }
}

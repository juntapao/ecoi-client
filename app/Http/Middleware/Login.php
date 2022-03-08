<?php

namespace App\Http\Middleware;
use Illuminate\Http\Request;
use Closure;

class Login
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
        if (session('login')=='LoggedIn'){
            
        }else{
            return redirect('/');
        }
    }
}

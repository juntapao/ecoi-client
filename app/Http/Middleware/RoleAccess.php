<?php

namespace App\Http\Middleware;

use Illuminate\Support\Facades\Route;
// use Illuminate\Support\Arr;
use Closure;

class RoleAccess
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
        $path = explode('/', request()->path())[1];
        $route = explode('.', Route::currentRouteName())[0];

        switch($route) {
            case 'roles': {
                $route = 'role';
                break;
            }
            case 'users': {
                $route = 'user';
                break;
            }
            default: $route = $route;
        }

        // if($path != $route) {
        if(!in_array($route, session('userRole'))) {
            // session(['error' => 'You are not allowed to access this page. '.$route.'|'.json_encode(session('userRole')).'|'.in_array($route, session('userRole'))]);
            session(['error' => 'You are not allowed to access this page.']);
            return redirect('/dashboard');
        }
        
        // session(['success' => 'testing. '.$route.'|'.json_encode(session('userRole')).'|'.in_array($route, session('userRole'))]);
        return $next($request);
    }
}

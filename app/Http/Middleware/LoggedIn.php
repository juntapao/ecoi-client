<?php
namespace App\Http\Middleware;
use Closure;
class LoggedIn {
    public function handle($request, Closure $next) {
        return $next($request);
    }
}

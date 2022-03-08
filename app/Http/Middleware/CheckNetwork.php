<?php

namespace App\Http\Middleware;

use App\Http\Controllers\CommonController;

use Closure;

class CheckNetwork
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
        $terminal_signature = session('terminalSignature');

        $body = [
            'terminal_signature' => $terminal_signature,
        ];

        $server_data = CommonController::curl(env('ECOI_SERVER_URL').'/api/status', 'get', $body);

        session(['network-status' => true]);

        // dd($server_data, env('ECOI_SERVER_URL').'/api/status');

        if(!$server_data) {
            session()->forget('network-status');
        } else {
            if($server_data->status_code != '200') {
                session()->forget('network-status');
            }
        }

        return $next($request);
    }
}

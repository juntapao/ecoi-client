<?php

namespace App\Http\Middleware;

use Closure;
use App\Http\Controllers\CommonController;
use App\Setting;
use App\Transaction;

class SyncTransactions
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
        $transactions = Transaction::where('uploaded', false)->get();

        if($transactions->count()) {

            $terminal_signature = session('terminalSignature');

            foreach($transactions as $transaction) {
                $transaction->terminal_id = session('terminalId');
            }

            $body = [
                'terminal_signature' => $terminal_signature,
                'data' => json_encode($transactions->toArray()),
            ];

            $server = CommonController::curl(config('app.ecoi_server_url').'/api/sync-transactions', 'post', $body);

            if(isset($server->status_code)) {
                if($server->status_code == 200 && isset($server->data)) {
                    foreach($server->data as $key => $value) {
                        Transaction::where('terminal_coi_number', $value)
                            ->update([
                                'coi_number' => str_pad($key, 8, '0', STR_PAD_LEFT),
                                'uploaded' => true,
                            ]);
                    }
                }
            }
        }

        return $next($request);
    }
}

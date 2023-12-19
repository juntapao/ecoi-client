<?php

namespace App\Console\Commands;

use App\Setting;
use App\Transaction;
use Illuminate\Console\Command;
use App\Http\Controllers\CommonController;

class ReSyncTransactions extends Command
{
    protected $signature = 'resync:transactions';
    protected $description = 'Resync Transactions';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $body = [
            'terminal_signature' => Setting::find(1)->value
        ];

        $server = CommonController::curl(config('app.ecoi_server_url').'/api/cancelled-transactions', 'post', $body);

        if(isset($server->status_code)){
            if($server->status_code == 200 && isset($server->data)) {
                Transaction::whereIn('coi_number', $server->data)
                    ->where('status', '!=', 'deleted')
                    ->update([
                        'uploaded' => false,
                    ]);
            }
        }
    }
}

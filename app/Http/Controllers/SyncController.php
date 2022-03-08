<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Transaction;

class SyncController extends Controller
{
    public static function sync()
    {
        try {
            // $transactions = Transaction::where('uploaded', false)
            //     ->get();

            // dd($transactions);
        } catch(\Exceptions $exceptions) {
            
        }
    }
}

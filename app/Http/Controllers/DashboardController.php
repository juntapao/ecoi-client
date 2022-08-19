<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// use Illuminate\Support\Facades\Auth;
// use App\User;
// use App\Menu;
// use App\UserRole;
use App\Transaction;
use DB;

class DashboardController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        // Auth::logout();

        // dd(session('parentmenu'));

        return view('dashboard');

    }
    
    public function sample()
    {
        return view('sample');
    }
}

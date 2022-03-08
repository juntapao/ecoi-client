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
        
        // $useroleid = auth()->user()->role_id;
        // $userroleall = UserRole::find($useroleid);
        // $userrole = explode(',',$userroleall->access);
        ////$sqlmenu = implode(',', $userrole);
//
//
        ////$subsqlmenu = DB::table('menu')->distinct()
        ////            ->select('parent')
        ////            ->whereIn('name', $userroleall->access);

        // $user_role = array();
        // foreach ($userrole as $key => $value) {
        //     $user_role[] = "'".$value."'";
        // }
        ////print_r($user_role);
        //$sqlmenu = implode(',', $user_role);
        ////echo $sqlmenu;
        //$subsqlmenu = DB::select(DB::raw('SELECT DISTINCT `parent` FROM `menu` WHERE `name` IN ('.$sqlmenu.')'));

        //// $subsqlmenu = Menu::whereIn('name', $userroleall->access)
        ////             ->groupBy('parent')
        ////             ->get();
       ////print_r($subsqlmenu);
    //    $role = array();
       
    //    foreach ($subsqlmenu as $key => $object) {
    //         $roles[] = $object->parent;
    //     }
        //// print_r($roles);
        //// print_r($userrole);
        // $parentmenu = Menu::all()
        //             ->where('status',1)
        //             ->whereIn('id', $roles)
        //             ->where('parent', 0);
        //// $parentmenus = DB::select(DB::raw('SELECT `id`,`name`,`label` from `menu` WHERE `id` in ('.$sqlmenu.') and `parent` = 0 '));
        //// $parentmenuid = array();
        //// $parentmenuname = array();
        //// $parentmenuidlabel = array();
        //// foreach ($parentmenus as $key => $value) {
        ////     $parentmenuid[]= $value->id;
        //// }
        //// print_r($parentmenuid);
        
        // $childmenu = Menu::all()
        //             ->where('status',1)
        //             ->whereIn('name', $userrole)
        //             ->where('parent','!=', 0 );

        //// $userrole = explode(',',session('roles'));
        //// print_r($userrole);

        // $user_id = auth()->user()->id;
        // $user = User::find($user_id);
        // return view('dashboard', compact('user'));

        // Transaction::whereNull('posted')
        //     // ->where('type', 'A')
        //     ->where('date_issued', '<', DB::raw('CURDATE()'))
        //     ->where('userbranch', session('branchName'))
        //     ->where('status', '!=', 'deleted')
        //     ->update(['status' => 'deleted']);

        return view('dashboard');

    }
    
    public function sample()
    {
        return view('sample');
    }
}

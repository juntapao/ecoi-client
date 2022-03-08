<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Menu;
use App\UserRole;
use App\DB;

class NavController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $useroleid = auth()->user()->role_id;
        // $userroleall = UserRole::find($useroleid);
        // $userrole = explode(",",$userroleall->access);
        // $sqlmenu= "";
        // foreach ($userrole as $useraccess) {
        //     $sqlmenu = "'".$sqlmenu."',";
        // }
        // $sqlmenu = substr($sqlmenu,0,-1);
        // $parentmenu = Menu::all()
        //             ->where('status',1)
        //             ->whereIn('id', (Menu::find('parent')
        //                         ->whereIn('name',$sqlmenu)
        //             ));
        
            $wew = 'WEW';

        return view('layouts.app', compact('userrole','wew'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

<?php

namespace App\Http\Controllers;
use App\Transaction;

use Illuminate\Http\Request;

class RegisteredController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $transaction =  Transaction::all()
            ->where('posted',1)
            ->whereNotIn('status', 'deleted');
        
        foreach($transaction as $types){
            $coi = self::getCoi($types->type);
            $transaction->coi_names = ($coi);
            return view('registered.index')->with('transaction', $transaction);
            //echo $transaction->coi_names;
        }
        
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
    public static function getCoi($coi_code) {
        $code_name = '';
        switch($coi_code) {
            case 'A':   $code_name = 'Family Protect - Plus';   break;
            case 'AO':  $code_name = 'KP Protect';              break;
            case 'B':   $code_name = 'Pinoy Protect - Plus';    break;
            case 'D':   $code_name = 'Family Protect';          break;
            case 'R':   $code_name = 'Pawners Protect';         break;
        }
        return $code_name;
    }
}

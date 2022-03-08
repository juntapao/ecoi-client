<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SetupController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            ini_set('max_execution_time', 0);

            if(session('initial-process')) {
                $update_process = collect([
                    ['name' => 'settings', 'status' => 'loading'],
                    ['name' => 'menus', 'status' => 'pending'],
                    ['name' => 'roles', 'status' => 'pending'],
                    ['name' => 'users', 'status' => 'pending'],
                    ['name' => 'regions', 'status' => 'pending'],
                    ['name' => 'areas', 'status' => 'pending'],
                    ['name' => 'branches', 'status' => 'pending'],
                    ['name' => 'prices', 'status' => 'pending'],
                    // ['name' => 'clean_up', 'status' => 'pending'],
                ]);
                session()->forget('initial-process');
            } else {
                $update_process = session('update-process');
    
                $current_process = $update_process->where('status', 'loading')->first()['name'];
    
                switch($current_process) {
                    case 'settings': {
                        $result = UpdateController::sync('settings');
                        if($result) {
                            $update_process = collect([
                                ['name' => 'settings', 'status' => 'completed'],
                                ['name' => 'menus', 'status' => 'loading'],
                                ['name' => 'roles', 'status' => 'pending'],
                                ['name' => 'users', 'status' => 'pending'],
                                ['name' => 'regions', 'status' => 'pending'],
                                ['name' => 'areas', 'status' => 'pending'],
                                ['name' => 'branches', 'status' => 'pending'],
                                ['name' => 'prices', 'status' => 'pending'],
                                // ['name' => 'clean_up', 'status' => 'pending'],
                            ]);
                        }
                        break;
                    }
                    case 'menus': {
                        $result = UpdateController::sync('menus');
                        if($result) {
                            $update_process = collect([
                                ['name' => 'settings', 'status' => 'completed'],
                                ['name' => 'menus', 'status' => 'completed'],
                                ['name' => 'roles', 'status' => 'loading'],
                                ['name' => 'users', 'status' => 'pending'],
                                ['name' => 'regions', 'status' => 'pending'],
                                ['name' => 'areas', 'status' => 'pending'],
                                ['name' => 'branches', 'status' => 'pending'],
                                ['name' => 'prices', 'status' => 'pending'],
                                // ['name' => 'clean_up', 'status' => 'pending'],
                            ]);
                        }
                        break;
                    }
                    case 'roles': {
                        $result = UpdateController::sync('roles');
                        if($result) {
                            $update_process = collect([
                                ['name' => 'settings', 'status' => 'completed'],
                                ['name' => 'menus', 'status' => 'completed'],
                                ['name' => 'roles', 'status' => 'completed'],
                                ['name' => 'users', 'status' => 'loading'],
                                ['name' => 'regions', 'status' => 'pending'],
                                ['name' => 'areas', 'status' => 'pending'],
                                ['name' => 'branches', 'status' => 'pending'],
                                ['name' => 'prices', 'status' => 'pending'],
                                // ['name' => 'clean_up', 'status' => 'pending'],
                            ]);
                        }
                        break;
                    }
                    case 'users': {
                        $result = UpdateController::sync('users');
                        if($result) {
                            $update_process = collect([
                                ['name' => 'settings', 'status' => 'completed'],
                                ['name' => 'menus', 'status' => 'completed'],
                                ['name' => 'roles', 'status' => 'completed'],
                                ['name' => 'users', 'status' => 'completed'],
                                ['name' => 'regions', 'status' => 'loading'],
                                ['name' => 'areas', 'status' => 'pending'],
                                ['name' => 'branches', 'status' => 'pending'],
                                ['name' => 'prices', 'status' => 'pending'],
                                // ['name' => 'clean_up', 'status' => 'pending'],
                            ]);
                        }
                        break;
                    }
                    case 'regions': {
                        $result = UpdateController::sync('regions');
                        if($result) {
                            $update_process = collect([
                                ['name' => 'settings', 'status' => 'completed'],
                                ['name' => 'menus', 'status' => 'completed'],
                                ['name' => 'roles', 'status' => 'completed'],
                                ['name' => 'users', 'status' => 'completed'],
                                ['name' => 'regions', 'status' => 'completed'],
                                ['name' => 'areas', 'status' => 'loading'],
                                ['name' => 'branches', 'status' => 'pending'],
                                ['name' => 'prices', 'status' => 'pending'],
                                // ['name' => 'clean_up', 'status' => 'pending'],
                            ]);
                        }
                        break;
                    }
                    case 'areas': {
                        $result = UpdateController::sync('areas');
                        if($result) {
                            $update_process = collect([
                                ['name' => 'settings', 'status' => 'completed'],
                                ['name' => 'menus', 'status' => 'completed'],
                                ['name' => 'roles', 'status' => 'completed'],
                                ['name' => 'users', 'status' => 'completed'],
                                ['name' => 'regions', 'status' => 'completed'],
                                ['name' => 'areas', 'status' => 'completed'],
                                ['name' => 'branches', 'status' => 'loading'],
                                ['name' => 'prices', 'status' => 'pending'],
                                // ['name' => 'clean_up', 'status' => 'pending'],
                            ]);
                        }
                        break;
                    }
                    case 'branches': {
                        $result = UpdateController::sync('branches');
                        if($result) {
                            $update_process = collect([
                                ['name' => 'settings', 'status' => 'completed'],
                                ['name' => 'menus', 'status' => 'completed'],
                                ['name' => 'roles', 'status' => 'completed'],
                                ['name' => 'users', 'status' => 'completed'],
                                ['name' => 'regions', 'status' => 'completed'],
                                ['name' => 'areas', 'status' => 'completed'],
                                ['name' => 'branches', 'status' => 'completed'],
                                ['name' => 'prices', 'status' => 'loading'],
                                // ['name' => 'clean_up', 'status' => 'pending'],
                            ]);
                        }
                        break;
                    }
                    case 'prices': {
                        $result = UpdateController::sync('prices');
                        if($result) {
                            $update_process = collect([
                                ['name' => 'settings', 'status' => 'completed'],
                                ['name' => 'menus', 'status' => 'completed'],
                                ['name' => 'roles', 'status' => 'completed'],
                                ['name' => 'users', 'status' => 'completed'],
                                ['name' => 'regions', 'status' => 'completed'],
                                ['name' => 'areas', 'status' => 'completed'],
                                ['name' => 'branches', 'status' => 'completed'],
                                ['name' => 'prices', 'status' => 'completed'],
                                // ['name' => 'clean_up', 'status' => 'loading'],
                            ]);
                        }
                        break;
                    }
                    // case 'clean_up': {
                    //     $result = UpdateController::sync('prices');
                    //     if($result) {
                    //         $update_process = collect([
                    //             ['name' => 'settings', 'status' => 'completed'],
                    //             ['name' => 'menus', 'status' => 'completed'],
                    //             ['name' => 'roles', 'status' => 'completed'],
                    //             ['name' => 'users', 'status' => 'completed'],
                    //             ['name' => 'regions', 'status' => 'completed'],
                    //             ['name' => 'areas', 'status' => 'completed'],
                    //             ['name' => 'branches', 'status' => 'completed'],
                    //             ['name' => 'prices', 'status' => 'completed'],
                    //             ['name' => 'clean_up', 'status' => 'completed'],
                    //         ]);
                    //     }
                    //     break;
                    // }
                    default: {
                        return redirect()->route('login');
                    }
                }
            }
        } catch(\Exception $exception) {
            session(['update-process' => $update_process]);
            return view('initial-setup');
        }
        session(['update-process' => $update_process]);
        return view('initial-setup');
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

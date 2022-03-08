<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Rules\Password;
use App\User;
class ChangePasswordController extends Controller {
    public function index() { }
    public function create() { }
    public function store(Request $request) { }
    public function show($id) { }
    public function edit($id) {
        $user = User::find(auth()->user()->id);
        return view('maintenance.change_password.edit', compact('user'));
    }
    public function update(Request $request, $id) {
        $request->validate([
            'password' => ['required', new Password],
            'new_password' => 'required|confirmed',
            'new_password_confirmation' => 'required',
        ]);
        $user = User::find(auth()->user()->id);
        $user->password = bcrypt($request->new_password);
        if($user->save()) session(['success' => 'Password changed successfully']);
        else session(['error', 'Error on saving the passowrd']);
        return redirect()->route('change_password.edit', $user->id);
    }
    public function destroy($id) { }
}

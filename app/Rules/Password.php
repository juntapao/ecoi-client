<?php
namespace App\Rules;
use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\Hash;
class Password implements Rule {
    public function __construct() { }
    public function passes($attribute, $value) {
        if(Hash::check($value, auth()->user()->password)) return true;
        else return false;
    }
    public function message() {
        return 'Invalid password.';
    }
}

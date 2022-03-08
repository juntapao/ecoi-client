<?php
namespace App\Rules;
use Illuminate\Contracts\Validation\Rule;
class AgeRestriction2 implements Rule {
    public function __construct() { }
    public function passes($attribute, $value) {
        if($value) {
            $datetime1 = date_create($value);
            $datetime2 = date_create(date('Y-m-d'));
            $year = date_diff($datetime2, $datetime1)->format('%y');
            if($year >= 1 && $year <= 21) return true; // UP TO 21
            else return false;
        } else return true;
    }
    public function message() {
        return 'Age is restricted to 1-21 only.';
    }
}

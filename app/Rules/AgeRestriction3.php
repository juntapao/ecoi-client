<?php
namespace App\Rules;
use Illuminate\Contracts\Validation\Rule;
class AgeRestriction3 implements Rule {
    public function __construct() { }
    public function passes($attribute, $value) {
        if($value) {
            $datetime1 = date_create($value);
            $datetime2 = date_create(date('Y-m-d'));
            $year = date_diff($datetime2, $datetime1)->format('%y');
            if($year >= 18 && $year <= 70) return true; // AGE RESTRICTION 18-70 ONLY
            else return false;
        } else return true;
    }
    public function message() {
        return 'Invalid age';
    }
}

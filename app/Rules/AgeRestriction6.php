<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class AgeRestriction6 implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        if($value) {
            $datetime1 = date_create($value);
            $datetime2 = date_create(date('Y-m-d'));
            $year = date_diff($datetime2, $datetime1)->format('%y');
            if($year >= 17 && $year <= 75) return true; // AGE RESTRICTION 17-75 ONLY
            else return false;
        } else return true;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Age is restricted to 17-75 only.';
    }
}

<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class AlphabetStringOnly implements Rule
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
            $count = 0;
            $non_alpha = [0,1,2,3,4,5,6,7,8,9,'`','~','!','@','#','$','%','^','&','*','(',')','_','+','[',']','{','}','\\','|',';','"',"'",':',',','<','>','/','?'];

            foreach ($non_alpha as $n_a) {
                if(str_contains($value, $n_a))
                    $count++;
            }

            if($count > 0)
                return false;
            else
                return true;
        } else return true;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Invalid Character (no numeric, no alphanumeric or special character)';
    }
}

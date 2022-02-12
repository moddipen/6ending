<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use App\Models\Userprofile;

class CheckLowerLimit implements Rule
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
        //Check parent limit
        $check_limits = Userprofile::with("parent_limit")->whereHas("parent_limit")->where("user_id",auth()->user()->id)->first();
        if(!empty($check_limits)){
            if($value < $check_limits->parent_limit->min_limit){
                return false;
            }else{
                return true;
            }
        }else{
            return true;
        }    
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Limit can not be less then what is added by your parent.';
    }
}

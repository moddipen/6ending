<?php

namespace App\Rules;
use App\Models\Credit;

use Illuminate\Contracts\Validation\Rule;

class CheckCoins implements Rule
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
        //Check if user has available credits or not
        $find_total_coints_available = Credit::where('user_id',auth()->user()->id)->latest()->first();
        if(!empty($find_total_coints_available) && $find_total_coints_available->net_points >= $value){
            return true;
        }else{
            return false;
        }
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'You do not have enough coins to bet!';
    }
}

<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class CheckLimit implements Rule
{
    public $type;
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($type)
    {
        $this->type = $type;
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
        if(strpos($value, "|") !== false){
            $bet_limit = explode("|",$value);
            if($this->type == 61){
                if(abs($bet_limit[0] - $bet_limit[1]) > 60){
                    return false;
                }else{
                    return true;
                }
            }else{
                if(abs($bet_limit[0] - $bet_limit[1]) > 30){
                    return false;
                }else{
                    return true;
                }
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
        if($this->type == 61){
            return 'Score must have maximum 61 run gap!';
        }else{
            return 'Score must have maximum 31 run gap!';
        }        
    }
}

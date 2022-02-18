<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use App\Models\Userprofile;
class BettingLimit implements Rule
{
    public $lower_limit;
    public $upper_limit;
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
       
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
        //Check for master user
        $check_limits = Userprofile::with("parent_limit")->where("user_id",auth()->user()->id)->first();
        if(empty($check_limits->parent_limit)){
            //Check for supermaster
            $check_limits = Userprofile::with("parent_limit")->where("user_id",$check_limits->created_by)->first();
            if(empty($check_limits->parent_limit) && isset($check_limits->created_by)){
                //Check for subadmin
                $check_limits = Userprofile::with("parent_limit")->where("user_id",$check_limits->created_by)->first();
                if(empty($check_limits->parent_limit)){
                    //Check for Admin
                    $check_limits = Userprofile::with("parent_limit")->where("user_id",$check_limits->created_by)->first();
                    if(empty($check_limits->parent_limit)){
                        //Check for Super Admin
                        $check_limits = Userprofile::with("parent_limit")->where("user_id",$check_limits->created_by)->first();
                        if(empty($check_limits->parent_limit)){
                            return true;
                        }else{
                            $this->lower_limit = $check_limits->parent_limit->min_limit;
                            $this->upper_limit = $check_limits->parent_limit->max_limit;
                            if($value >= $check_limits->parent_limit->min_limit && $value <= $check_limits->parent_limit->max_limit){
                                return true;
                            }else{
                                return false;
                            }
                        }
                    }else{
                        $this->lower_limit = $check_limits->parent_limit->min_limit;
                        $this->upper_limit = $check_limits->parent_limit->max_limit;
                        if($value >= $check_limits->parent_limit->min_limit && $value <= $check_limits->parent_limit->max_limit){
                            return true;
                        }else{
                            return false;
                        }
                    }
                }else{
                    $this->lower_limit = $check_limits->parent_limit->min_limit;
                    $this->upper_limit = $check_limits->parent_limit->max_limit;
                    if($value >= $check_limits->parent_limit->min_limit && $value <= $check_limits->parent_limit->max_limit){
                        return true;
                    }else{
                        return false;
                    }
                }
            }else{
                $this->lower_limit = $check_limits->parent_limit->min_limit;
                $this->upper_limit = $check_limits->parent_limit->max_limit;
                if($value >= $check_limits->parent_limit->min_limit && $value <= $check_limits->parent_limit->max_limit){
                    return true;
                }else{
                    return false;
                }
            }
        }else{
            $this->lower_limit = $check_limits->parent_limit->min_limit;
            $this->upper_limit = $check_limits->parent_limit->max_limit;
            if($value >= $check_limits->parent_limit->min_limit && $value <= $check_limits->parent_limit->max_limit){
                return true;
            }else{
                return false;
            }
        }        
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'You can bet between '.$this->lower_limit.' to '.$this->upper_limit.' coins.';
    }
}

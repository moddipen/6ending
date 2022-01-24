<?php

namespace App\Http\Controllers\Backend;

use App\Authorizable;
use Exception;
use App\Models\Credit;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CreditController extends Controller
{
    use Authorizable;
    public function __construct()
    {
        // Page Title
        $this->module_title = 'Credit';

        // module name
        $this->module_name = 'credits';

        // directory path of the module
        $this->module_path = 'credits';

        // module icon
        $this->module_icon = 'c-icon cil-people';

        // module model name, path
        $this->module_model = "App\Models\Credit";
    }

    public function credit_update(Request $request)
    {
        $request->validate([
                'points' => 'required|numeric|gt:0' 
            ]
        );      
        $request_object = $request->all();
        $parent_transaction_type = "";
        $latest_record = Credit::where('user_id',$request_object['user_id'])->latest()->first();
        if(!empty($latest_record)){
            $check_parent_credit = Credit::where('user_id',auth()->user()->id)->latest()->first();
            if($request_object['type'] == "credit"){
                if(!empty($check_parent_credit) && $check_parent_credit->net_points >= $request_object['points']){
                    $net_points = $latest_record->net_points + $request_object['points'];
                    $net_points_parents = abs($request_object['points'] - $check_parent_credit->net_points);                    
                    $parent_transaction_type = "debit";
                }else{
                    return response()->json([
                        'errors'=>array("points"=>array('You do not have enough coins to credit.'))                     
                    ],422);   
                }                
            }else{
                $net_points = abs($request_object['points'] - $latest_record->net_points);
                $net_points_parents = $check_parent_credit->net_points + $request_object['points'];
                $parent_transaction_type = "credit";
            }
        }else{
            $check_parent_credit = Credit::where('user_id',auth()->user()->id)->latest()->first();
            $net_points = $request_object['points'];   
            if($request_object['type'] == "credit"){
                if(!empty($check_parent_credit) && $check_parent_credit->net_points >= $request_object['points']){
                    $net_points_parents = abs($request_object['points'] - $check_parent_credit->net_points);                    
                    $parent_transaction_type = "debit";
                }else{
                    return response()->json([
                        'errors'=>array("points"=>array('You do not have enough coins to credit.'))                                        
                    ],422);  
                }
            }else{
                $net_points_parents = $check_parent_credit->net_points + $request_object['points'];
                $parent_transaction_type = "credit";
            }    
        }

        //Credit to user
        $create_insert_object = array(
            "user_id" => $request_object['user_id'],
            "parent_id" => auth()->user()->id,
            "points" => $request_object['points'],
            "net_points" => $net_points,
            "type" => $request_object['type'] 
        );
        Credit::create($create_insert_object);

        //Debit from Parent
        $crate_parent_coins = array(
            "user_id" => auth()->user()->id,
            "parent_id" => $check_parent_credit->parent_id,
            "points" => $request_object['points'],
            "net_points" => $net_points_parents,
            "type" => $parent_transaction_type
        );
        Credit::create($crate_parent_coins);        
        return response()->json(['success'=>'Points updated']);   
    }
}

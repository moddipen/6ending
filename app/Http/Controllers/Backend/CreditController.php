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
        $latest_record = Credit::where('user_id',$request_object['user_id'])->latest()->first();
        if(!empty($latest_record)){
            if($request_object['type'] == "credit"){
                $net_points = $latest_record->net_points + $request_object['points'];
            }else{
                $net_points = abs($request_object['points'] - $latest_record->net_points);
            }
        }else{
            $net_points = $request['points'];          
        }
        $create_insert_object = array(
            "user_id" => $request_object['user_id'],
            "parent_id" => auth()->user()->id,
            "points" => $request['points'],
            "net_points" => $net_points,
            "type" => $request_object['type'] 
        );
        Credit::create($create_insert_object);
        return response()->json(['success'=>'Points updated']);   
    }
}

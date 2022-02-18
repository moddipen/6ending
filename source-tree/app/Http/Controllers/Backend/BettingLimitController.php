<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Flash;
use App\Rules\CheckLowerLimit;
use App\Rules\CheckUpperLimit;
use App\Models\BettingLimit;
use App\Authorizable;

class BettingLimitController extends Controller
{
    // use Authorizable;

    public function __construct()
    {
        $this->middleware('auth')->except("store");
        // Page Title
        $this->module_title = 'BettingLimit';

        // module name
        $this->module_name = 'betting_limit';

        // directory path of the module
        $this->module_path = 'betting_limit';

        // module  mode name , path
        $this->module_model = "App\Models\BettingLimit";
    }

    public function store(Request $request){
        $request->validate([
            'min_limit' => ['required','numeric', 'gt:0', new CheckLowerLimit()],
            'max_limit' => ['required','numeric', 'gt:min_limit', new CheckUpperLimit()]
        ]);
        $request_object = $request->all();
        $check_if_exists = BettingLimit::where("user_id",auth()->user()->id)->first();
        if(!empty($check_if_exists)){
            $create_save_object = array(
                "min_limit" => $request_object['min_limit'],
                "max_limit" => $request_object['max_limit']
            );
            BettingLimit::where("user_id" , auth()->user()->id)->update($create_save_object);
        }else{
            $create_save_object = array(
                "user_id" => auth()->user()->id,
                "min_limit" => $request_object['min_limit'],
                "max_limit" => $request_object['max_limit']
            );
            BettingLimit::create($create_save_object);
        }        
        Flash::success('Limits Set Successfully')->important();
        return redirect()->back(); 
    }

    public function index(){
        exit("dasd");
    }
}

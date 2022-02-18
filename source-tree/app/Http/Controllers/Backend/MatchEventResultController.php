<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Authorizable;
use App\Http\Controllers\Controller;
use App\Models\MatchEventResult;

class MatchEventResultController extends Controller
{
    use Authorizable;
    public function __construct()
    {
        // Page Title
        $this->module_title = 'Event Managment';

        // module name
        $this->module_name = 'matchevents';

        // directory path of the module
        $this->module_path = 'matchevents';

        // module icon
        $this->module_icon = 'c-icon cil-task';

        // module model name, path
        $this->module_model = "App\Models\MatchEventResult";
    }

    public function update_result(Request $request){
        $validatedData = $request->validate([
            'id' => 'required',
            'result' => 'required'
        ]);     
        $request_object = $request->all();
        $create_insert_object = array(
            "result" => $request_object['result'],
            "match_event_id" => $request_object['id']
        );
        MatchEventResult::create($create_insert_object);
        return response()->json(['success'=>'Success!!']); 
    }
}

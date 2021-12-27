<?php
namespace App\Http\Controllers\Backend;

use App\Authorizable;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Role;
use App\Models\Matchtype;
use App\Models\Eventtype;


class EventtypeController extends Controller
{
    use Authorizable;
    public function __construct()
    {
        // Page Title
        $this->module_title = 'Event Types';

        // module name
        $this->module_name = 'eventtype';

        // directory path of the module
        $this->module_path = 'eventtype';

        // module icon
        $this->module_icon = 'c-icon cil-task';

        // module model name, path
        $this->module_model = "App\Models\Eventtype";
    }

    public function ajax_dropdown_list(Request $request){
        $match_id = $request->match_id;
        $get_event_data = Eventtype::whereDoesntHave("matchtypeevents",function ($query) use($match_id) {
            $query->where('matchtype_id',$match_id);                             
        })->pluck('type','id');  
        if($get_event_data->count() > 0){
            return response()->json(['sucess'=>'success','data'=>$get_event_data->toArray()]); 
        }else{
            return response()->json(['sucess'=>'failure','data'=>'No record found']); 
        }        
    }
}

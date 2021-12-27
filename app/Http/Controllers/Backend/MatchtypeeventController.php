<?php

namespace App\Http\Controllers\Backend;

use App\Authorizable;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Role;
use App\Models\Matchtype;
use App\Models\Matchtypeevent;
use App\Models\Eventtype;
use App\Models\Permission;

class MatchtypeeventController extends Controller
{
    use Authorizable;

    public function __construct()
    {
        // Page Title
        $this->module_title = 'Event Managment';

        // module name
        $this->module_name = 'eventmanagers';

        // directory path of the module
        $this->module_path = 'eventmanagers';

        // module icon
        $this->module_icon = 'c-icon cil-task';

        // module model name, path
        $this->module_model = "App\Models\Matchtypeevent";
    }

    public function index()
    {

    }
    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $module_title = $this->module_title;
        $module_name = $this->module_name;
        $module_path = $this->module_path;
        $module_icon = $this->module_icon;
        $module_model = $this->module_model;
        $module_name_singular = Str::singular($module_name);

        $module_action = 'Create';

        $roles = Role::get();
        $permissions = Permission::select('name', 'id')->get();
        $get_match_types = Matchtype::pluck('type','id');
        $get_event_types = Eventtype::pluck('type','id');
        
        return view(
            "backend.$module_name.create",
            compact('module_title', 'module_name', 'module_path', 'module_icon', 'module_action', 'module_name_singular', 'roles', 'permissions','get_match_types','get_event_types')
        );
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'matchtype_id' => 'required',
            'eventtype_id' => 'required',
            'bet_coin' => 'required',
            'win_coin' => 'required'
        ]);     
        $request_object = $request->all();
        $create_record = array(
            "matchtype_id" => $request_object['matchtype_id'],
            "eventtype_id" => $request_object['eventtype_id'],
            "bet_coin" => $request_object['bet_coin'],
            "win_coin" => $request_object['win_coin']
        );
        Matchtypeevent::create($create_record);
    }
}
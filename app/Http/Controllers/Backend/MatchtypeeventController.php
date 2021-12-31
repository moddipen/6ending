<?php

namespace App\Http\Controllers\Backend;

use App\Authorizable;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Role;
use App\Models\Matchtype;
use App\Models\Matchtypeevent;
use Illuminate\Support\Facades\DB;
use App\Models\Eventtype;
use App\Models\Permission;
use Yajra\DataTables\DataTables;

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
        $module_title = $this->module_title;
        $module_name = $this->module_name;
        $module_path = $this->module_path;
        $module_icon = $this->module_icon;
        $module_model = $this->module_model;
        $module_name_singular = Str::singular($module_name);

        $module_action = 'List';

        return view(
            "backend.$module_name.index",
            compact('module_title', 'module_name', 'module_path', 'module_icon', 'module_action', 'module_name_singular')
        );
    }

    public function datatable(){
        $module_title = $this->module_title;
        $module_name = $this->module_name;
        $module_path = $this->module_path;
        $module_icon = $this->module_icon;
        $module_model = $this->module_model;
        $module_name_singular = Str::singular($module_name);

        $module_action = 'List';

        $$module_name =  DB::table('matchtypeevents')->join('eventtypes','eventtypes.id', '=','matchtypeevents.eventtype_id')->join('matchtypes','matchtypes.id', '=','matchtypeevents.matchtype_id')->select(['matchtypeevents.id', 'matchtypes.type as matchType', 'eventtypes.type as eventType', 'matchtypeevents.bet_coin', 'matchtypeevents.win_coin','matchtypeevents.status']);
        
        $data = $$module_name;
        
        return Datatables::of($data)
        ->addColumn('action', function ($data) {
            if($data->status == 0){
                return '<div class="checkbox"><input data-class="btn-block" id="kv-toggle-demo" data-id="'.$data->id.'" value="0" type="checkbox" checked data-toggle="toggle" data-on="Active" data-off="Inactive" data-onstyle="success" data-offstyle="warning"></div>';
            }else{
                return '<div class="checkbox"><input data-class="btn-block" id="kv-toggle-demo" data-id="'.$data->id.'" value="1" type="checkbox" data-toggle="toggle" data-on="Active" data-off="Inactive" data-onstyle="success" data-offstyle="warning"></div>';
            }            
        })
        ->editColumn('matchType',  function ($data) {
            return $data->matchType;
        })
        ->editColumn('eventType', function ($data) {
            return $data->eventType;
        })
        ->editColumn('bet_coin', function ($data) {
            return $data->bet_coin;
        })
        ->editColumn('win_coin', function ($data) {
            return '<div class="row">
                            <div class="input-group col-lg-3 input-group-sm mb-3">
                                <input type="text" value="'.$data->win_coin.'" data-val-required="Required" name="amount" class="form-control amount-customization" aria-label="Small" aria-describedby="inputGroup-sizing-sm">
                                <div class="invalid-feedback order-last">This field is required.</div>
                                <div style="display:none; cursor:pointer;" class="input-group-append" data-id="'.$data->id.'">
                                    <span class="input-group-text" id="inputGroup-sizing-sm">
                                        <i class="fas fa-user-edit"></i>
                                    </span>
                                </div>
                            </div>                                           
                        </div> ';            
        })      
        ->rawColumns(['win_coin','action'])
        // ->orderColumns(['id'], '-:column $1')
        ->make(true);
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

    public function update(Request $request){
        $request_object = $request->all();
        Matchtypeevent::where("id",$request_object['id'])->update(['win_coin'=>$request_object['win_coin']]);
    }

    public function update_status(Request $request){
        $request_object = $request->all();
        Matchtypeevent::where("id",$request_object['id'])->update(['status'=>$request_object['status']]);
    }
}
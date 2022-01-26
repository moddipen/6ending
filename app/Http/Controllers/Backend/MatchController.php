<?php

namespace App\Http\Controllers\Backend;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Matchtype;
use App\Models\Match;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;
use App\Models\Matchtypeevent;

class MatchController extends Controller
{
    public function __construct()
    {
        // Page Title
        $this->module_title = 'Matches';

        // module name
        $this->module_name = 'matches';

        // directory path of the module
        $this->module_path = 'matches';

        // module icon
        $this->module_icon = 'c-icon cil-task';

        // module model name, path
        $this->module_model = "App\Models\Match";
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
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
            compact('module_name', 'module_path', 'module_icon', 'module_action', 'module_name_singular','module_title')
        );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
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

        $match_types = Matchtype::pluck('type','id');
        return view(
            "backend.$module_name.create",
            compact('match_types', 'module_name', 'module_path', 'module_icon', 'module_action', 'module_name_singular','module_title')
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

        $$module_name =  DB::table('matches')
        ->join('matchtypes','matchtypes.id', '=','matches.matchtype_id')
        ->select(['matches.id','matches.team_1', 'matchtypes.type as matchType', 'matches.team_2', 'matches.status','matches.matchtype_id']);
        
        $data = $$module_name;
        
        return Datatables::of($data)
        ->addColumn('status', function ($data) {
            if($data->status == 0){
                return '<div class="checkbox row col-lg-6"><input data-class="btn-block" id="kv-toggle-demo" data-id="'.$data->id.'" value="0" type="checkbox" checked data-toggle="toggle" data-on="Active" data-off="Inactive" data-onstyle="success" data-offstyle="warning"></div>';
            }else{
                return '<div class="checkbox row col-lg-6"><input data-class="btn-block" id="kv-toggle-demo" data-id="'.$data->id.'" value="1" type="checkbox" data-toggle="toggle" data-on="Active" data-off="Inactive" data-onstyle="success" data-offstyle="warning"></div>';
            }            
        })
        ->addColumn('action', function ($data) {
            return '<a href="'.route("backend.matches.events.list",['id'=>\Crypt::encrypt($data->matchtype_id),'match_id'=>$data->id]).'" class="btn btn-info btn-sm mt-1" data-toggle="tooltip" title="Match events"><i class="fas fa-universal-access"></i></a>';         
        })
        ->editColumn('matchType',  function ($data) {
            return $data->matchType;
        })
        ->editColumn('team_1', function ($data) {
            return $data->team_1;
        })
        ->editColumn('team_2', function ($data) {
            return $data->team_2;
        })
        ->rawColumns(['status','action'])
        ->make(true);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'matchtype_id' => 'required',
            'team_1' => 'required|regex:/^[\pL\s]+$/u|max:255',
            'team_2' => 'required|regex:/^[\pL\s]+$/u|max:255',
            'schedule' => 'required',
            'status' => 'required'
        ],
        [
            'matchtype_id.required' => 'The Match Type field is required!'
        ]);   
        
        $request_object = $request->all();
        $create_record = array(
            "matchtype_id" => $request_object['matchtype_id'],
            "team_1" => $request_object['team_1'],
            "team_2" => $request_object['team_2'],
            "status" => $request_object['status'],
            "schedule" => \Carbon\Carbon::parse($request_object['schedule'])->toDateTimeString()
        );
        Match::create($create_record);
        return redirect()->route('backend.matches.index')->withStatus(__('Record successfully created.'));          
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function update_status(Request $request){
        $request_object = $request->all();
        Match::where("id",$request_object['id'])->update(['status'=>$request_object['status']]);
    }

    public function update_type(Request $request){
        $request_object = $request->all();
        Matchtypeevent::where("id",$request_object['id'])->update(['type'=>$request_object['type']]);
    }

    public function event_backend($id,$match_id){
        $module_title = $this->module_title;
        $module_name = $this->module_name;
        $module_path = $this->module_path;
        $module_icon = $this->module_icon;
        $module_model = $this->module_model;
        $module_name_singular = Str::singular($module_name);

        $module_action = 'Event List';

        $id = \Crypt::decrypt($id);
        $get_match_events = Matchtypeevent::with(["match_types","event_types","match_result","match_to_list"=> function($q) use($match_id) {
            // Query the name field in status table
            $q->where('id', $match_id); // '=' is optional
        }])->where("matchtype_id",$id)->get();
        // echo "<pre>";
        // print_R($get_match_events->toArray());exit;
        return view('backend.matches.events_backend',compact('module_name', 'module_path', 'module_icon', 'module_action', 'module_name_singular','module_title','get_match_events','match_id'));        
    }

    public function events($id,$match_id){
        $id = \Crypt::decrypt($id);
        $get_match_events = Matchtypeevent::with(["match_types","event_types","match_to_list"=> function($q) use($match_id) {
            // Query the name field in status table
            $q->where('id', $match_id); // '=' is optional
        }])->where("matchtype_id",$id)->get();
        // echo "<pre>";
        // print_R($get_match_events->toArray());exit;
        return view('backend.matches.events',["get_match_events"=>$get_match_events,"match_id"=>$match_id]);        
    }
}

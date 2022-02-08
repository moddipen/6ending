<?php

namespace App\Http\Controllers\Backend;
use App\Http\Controllers\Controller;
use App\Authorizable;
use Illuminate\Http\Request;
use App\Models\Credit;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;

class ReportController extends Controller
{
    use Authorizable;
    
    public function __construct()
    {
        // Page Title
        $this->module_title = 'Reports';

        // module name
        $this->module_name = 'reports';

        // directory path of the module
        $this->module_path = 'reports';

        // module icon
        $this->module_icon = 'c-icon cil-people';        
    }

    public function credit_debit_report(){
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

    public function credit_debit_report_datatable(){
        $$module_name =  DB::table('credits')
        ->join('users','users.id', '=','credits.user_id')
        ->join('users','users.id', '=','credits.parent_id')
        ->select("*");
        
        $data = $$module_name;
        echo "<pre>";
        print_r($data);exit;
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
        ->editColumn('is_settled', function ($data) {
            if($data->is_settled == 0){
                return "No";
            }else{
                return "Yes";
            }            
        })
        ->editColumn('team_2', function ($data) {
            return $data->team_2;
        })
        ->rawColumns(['status','action'])
        ->make(true);
    }
}

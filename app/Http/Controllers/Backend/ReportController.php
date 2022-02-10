<?php

namespace App\Http\Controllers\Backend;
use App\Http\Controllers\Controller;
use App\Authorizable;
use Illuminate\Http\Request;
use App\Models\Credit;
use App\Models\Bet;
use Carbon\Carbon;
use Illuminate\Support\Str;
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
        $this->module_model = "";
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
            compact('module_name', 'module_path', 'module_icon', 'module_action', 'module_name_singular', 'module_title')
        );
    }

    public function credit_debit_report_datatable(){
        $module_name = Credit::with("user","parent_user")
        ->where(function ($query) {
            $query->where("type","credit")->orWhere("type","debit");
        })
        ->where("user_id",auth()->user()->id)->get();
        
        $data = $module_name;
        return Datatables::of($data)
        ->addColumn('created_at', function ($data) {
            return Carbon::createFromFormat('Y-m-d H:i:s', $data->created_at);
        })
        ->addColumn('from_to', function ($data) {
            if($data->type == "credit"){
                return $data->parent_user->first_name." ".$data->parent_user->last_name." / ".$data->user->first_name." ".$data->user->last_name;
            }else{
                return $data->user->first_name." ".$data->user->last_name." / ".$data->parent_user->first_name." ".$data->parent_user->last_name;
            }         
        })
        ->addColumn('debit_coin', function ($data) {
            if($data->type == "credit"){
                return "-";
            }else{
                return $data->points;
            }         
        })
        ->addColumn('credit_coin', function ($data) {
            if($data->type == "credit"){
                return $data->points;
            }else{
                return "-";
            }         
        })
        ->make(true);
    }

    public function betting_report(){
        $module_title = $this->module_title;
        $module_name = $this->module_name;
        $module_path = $this->module_path;
        $module_icon = $this->module_icon;
        $module_model = $this->module_model;
        $module_name_singular = Str::singular($module_name);

        $module_action = 'List';
        return view(
            "backend.$module_name.betting_index",
            compact('module_name', 'module_path', 'module_icon', 'module_action', 'module_name_singular', 'module_title')
        );
    }

    public function betting_report_datatable(){
        $module_name = Bet::with("match_event.match","match_event.matchtypeevent.event_types","match_event.matchtypeevent.match_types","settlement")->get();
        
        $data = $module_name;
        
        return Datatables::of($data)
        ->addColumn('match', function ($data) {
            return $data->match_event->match->team_1." vs ".$data->match_event->match->team_2."(".$data->match_event->matchtypeevent->match_types->type.")";
        })
        ->addColumn('event', function ($data) {
            return $data->match_event->matchtypeevent->event_types->type;
        })
        ->editColumn('created_at', function ($data) {
            return Carbon::createFromFormat('Y-m-d H:i:s', $data->created_at);
        })
        ->addColumn('settlement_time', function ($data) {
            return Carbon::createFromFormat('Y-m-d H:i:s', $data->settlement->created_at);
        })        
        ->make(true);
    }
}

<?php

namespace App\Http\Controllers\Backend;
use App\Http\Controllers\Controller;
use App\Authorizable;
use Illuminate\Http\Request;
use App\Models\Credit;
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
        $module_name = Credit::with("user","parent_user")->get();
        
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
        ->make(true);
    }
}

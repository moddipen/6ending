<?php

namespace App\Http\Controllers\Backend;
use App\Http\Controllers\Controller;
use App\Authorizable;
use Illuminate\Http\Request;
use App\Models\Credit;
use App\Models\Bet;
use App\Models\MatchEvent;
use App\Models\MatchEventSettlement;
use App\Models\Match;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;

class ReportController extends Controller
{
    use Authorizable;
    protected $settlements;
    
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
        $this->settlements = new MatchEventSettlement();
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

    public function credit_debit_report_datatable(Request $request){

        $request_object = $request->all();
        
        if($request_object['start_date'] != "" && $request_object['end_date'] != ""){
            $module_name = Credit::with("user","parent_user")
            ->where(function ($query) {
                $query->where("type","credit")->orWhere("type","debit");
            })
            ->whereBetween("created_at",[Carbon::createFromFormat('Y-m-d',$request_object['start_date']),Carbon::createFromFormat('Y-m-d',$request_object['end_date'])])
            ->where("user_id",auth()->user()->id)->get();           
        }else{
            $module_name = Credit::with("user","parent_user")
            ->where(function ($query) {
                $query->where("type","credit")->orWhere("type","debit");
            })
            ->where("user_id",auth()->user()->id)->get();
        }   
       
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

    public function betting_report_datatable(Request $request){
        $request_object = $request->all();
        
        if($request_object['start_date'] != "" && $request_object['end_date'] != ""){
            $module_name = Bet::with("match_event.match","match_event.matchtypeevent.event_types","match_event.matchtypeevent.match_types","settlement")
            ->whereBetween("created_at",[Carbon::createFromFormat('Y-m-d',$request_object['start_date']),Carbon::createFromFormat('Y-m-d',$request_object['end_date'])])
            ->where("type","placed")
            ->get();
        }else{
            $module_name = Bet::with("match_event.match","match_event.matchtypeevent.event_types","match_event.matchtypeevent.match_types","settlement")->where("type","placed")->get();
        }       
        
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
        ->make(true);
    }

    public function betting_history_report(){
        $module_title = $this->module_title;
        $module_name = $this->module_name;
        $module_path = $this->module_path;
        $module_icon = $this->module_icon;
        $module_model = $this->module_model;
        $module_name_singular = Str::singular($module_name);

        $module_action = 'List';
        return view(
            "backend.$module_name.betting_history_index",
            compact('module_name', 'module_path', 'module_icon', 'module_action', 'module_name_singular', 'module_title')
        );
    }

    public function betting_history_report_datatable(Request $request){
        $request_object = $request->all();
        
        if($request_object['start_date'] != "" && $request_object['end_date'] != ""){
            $module_name = Bet::with("match_event.match","match_event.matchtypeevent.event_types","match_event.matchtypeevent.match_types","user")
            ->whereBetween("created_at",[Carbon::createFromFormat('Y-m-d',$request_object['start_date']),Carbon::createFromFormat('Y-m-d',$request_object['end_date'])])
            ->get();
        }else{
            $module_name = Bet::with("match_event.match","match_event.matchtypeevent.event_types","match_event.matchtypeevent.match_types","user")->get();
        }
        
        
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
        ->addColumn('username', function ($data) {
            return $data->user->first_name." ".$data->user->last_name;
        })
        ->addColumn('p&l', function ($data) {
            if($data->status == "win"){
                return $this->settlements->net_point_calculation_winner($data->match_event->matchtypeevent->bet_coin, $data->match_event->matchtypeevent->win_coin,$data->bet_coins);
            }else if($data->status == "loss"){
                return "<p style='color:red;'>".$data->bet_coins."</p>";
            }else if($data->status == "tie"){
                return "TIE";
            }else{
                return "NA";
            }            
        })
        ->rawColumns(['p&l'])
        ->make(true);
    }

    public function profit_loss_report(){
        $module_title = $this->module_title;
        $module_name = $this->module_name;
        $module_path = $this->module_path;
        $module_icon = $this->module_icon;
        $module_model = $this->module_model;
        $module_name_singular = Str::singular($module_name);

        $module_action = 'List';
        return view(
            "backend.$module_name.profit_loss_index",
            compact('module_name', 'module_path', 'module_icon', 'module_action', 'module_name_singular', 'module_title')
        );
    }

    public function profit_loss_report_datatable(Request $request){
        // $module_name = MatchEvent::with("match.matchtype","matchtypeevent.event_types","loss_bet","won_bet","settlement")->whereHas("settlement")->get();
        $request_object = $request->all();
        
        if($request_object['start_date'] != "" && $request_object['end_date'] != ""){
            $module_name = Match::with("events.matchtypeevent","matchtype","events.loss_bet","events.won_bet","events.settlement")->whereHas("events.settlement")
            ->whereBetween("created_at",[Carbon::createFromFormat('Y-m-d',$request_object['start_date']),Carbon::createFromFormat('Y-m-d',$request_object['end_date'])])
            ->get();
        }else{
            $module_name = Match::with("events.matchtypeevent","matchtype","events.loss_bet","events.won_bet","events.settlement")->whereHas("events.settlement")->get();
        }
        
        $data = $module_name;
        return Datatables::of($data)
        ->addColumn('match', function ($data) {
            return $data->team_1." vs ".$data->team_2."(".$data->matchtype->type.")";
        })
        ->editColumn('created_at', function ($data) {
            return Carbon::createFromFormat('Y-m-d H:i:s', $data->created_at);
        })
        ->addColumn('settlement_time', function ($data) {
            if(!empty($data->events[0]->settlement[0]->created_at)){
                return Carbon::createFromFormat('Y-m-d H:i:s', $data->events[0]->settlement[0]->created_at);
            }else{
                return "-";
            }
        })
        ->addColumn('action', function ($data) {
            return '<a data-toggle="modal" data-backdrop="false" data-target="#detail-bet" data-id="'.$data->id.'" href="'.route('backend.match.details', $data->id).'" class="btn btn-success detail-bet" data-toggle="tooltip" title="" data-original-title="Detail">Detail</a>';
        })
        ->addColumn('p&l', function ($data) {
            $won_bet_total = 0;
            $loss_bet_total = 0;
            foreach($data->events as $event){
                foreach($event->won_bet as $ev){
                    $new_coin = $this->settlements->net_point_calculation_winner($event->matchtypeevent->bet_coin, $event->matchtypeevent->win_coin, $ev['bet_coins']);
                    $ev['bet_coins'] = $new_coin - $ev['bet_coins'];
                    $won_bet_total = $won_bet_total + $ev['bet_coins'];
                } 
                
                foreach($event->loss_bet as $ev){
                    $loss_bet_total = $loss_bet_total + $ev['bet_coins'];
                } 
            }
            return $won_bet_total - $loss_bet_total;
        })
        ->rawColumns(['action'])
        ->make(true);
    }

}

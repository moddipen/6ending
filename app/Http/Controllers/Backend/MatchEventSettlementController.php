<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Authorizable;
use Illuminate\Http\Request;
use App\Models\MatchEventSettlement;
use App\Models\MatchEvent;
use App\Models\Credit;
use App\Models\Match;

class MatchEventSettlementController extends Controller
{
    use Authorizable;
    public $match_event_settlement;
    public function __construct()
    {
        $this->match_event_settlement = new MatchEventSettlement;
        // Page Title
        $this->module_title = 'Settlements';

        // module name
        $this->module_name = 'settlements';

        // directory path of the module
        $this->module_path = 'settlements';

        // module icon
        $this->module_icon = 'c-icon cil-task';

        // module model name, path
        $this->module_model = "App\Models\MatchEventSettlement";
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request){
        $get_match_events = MatchEvent::with("match_result","matchtypeevent.event_types","bet.credit")->where("match_id",$request->match_id)->where("is_settled", 0)->get();
        if(!empty($get_match_events)){
            $get_match_events = $get_match_events->toArray();
            foreach($get_match_events as $event){                
                if(!empty($event['bet'])){
                    foreach($event['bet'] as $bet){
                        if($event['matchtypeevent']['event_types']['type'] == "One day Khada – 61 runs" || $event['matchtypeevent']['event_types']['type'] == "T20 Khada - 31 runs"){
                            $bet_limits = explode("|",$bet['result']);
                            if($event['match_result']['result'] >= $bet_limits[0] && $event['match_result']['result'] <= $bet_limits[1]){
                                $this->match_event_settlement->event_settlement('credit',$bet,$event['matchtypeevent'],$event['id']);
                            }else{
                                $this->match_event_settlement->event_settlement('debit',$bet,$event['matchtypeevent'],$event['id']);
                            }
                        }else{
                            if($event['match_result']['result'] == 0){
                                $this->match_event_settlement->toss_event_settlement('refund',$bet,$event['matchtypeevent'],$event['id']);
                            }else{
                                if(in_array($event['match_result']['result'],$bet)){
                                    $this->match_event_settlement->event_settlement('credit',$bet,$event['matchtypeevent'],$event['id']);
                                }else{
                                    $this->match_event_settlement->event_settlement('debit',$bet,$event['matchtypeevent'],$event['id']);
                                }
                            }  
                        }                                                  
                    }                        
                }      
                MatchEvent::where('id',$event['id'])->update(["is_settled" => 1]);
                Match::where('id',$event['match_id'])->update(["is_settled" => 1]);
            }   
                   
        }   
        flash('<i class="fas fa-check"></i> Match events are settled!')->success();
        return redirect("admin/matches/events/list/".\Crypt::encrypt('21')."/".$request->match_id."");     
    }
}

<?php

namespace App\Http\Controllers\Backend;

use App\Authorizable;
use Illuminate\Http\Request;
use Exception;
use App\Http\Controllers\Controller;
use App\Rules\CheckCoins;
use App\Rules\CheckLimit;
use App\Rules\BettingLimit;
use App\Models\Bet;
use App\Models\MatchEvent;
use App\Models\Credit;

class BetController extends Controller
{
    // use Authorizable;
    public function __construct()
    {
        // Page Title
        $this->module_title = 'Bet';

        // module name
        $this->module_name = 'bets';

        // directory path of the module
        $this->module_path = 'bets';

        // module icon
        $this->module_icon = 'c-icon cil-people';

        // module model name, path
        $this->module_model = "App\Models\Bet";
    }

    public function store(Request $request){
        if($request->type == "Lambi Run"){
            $request->validate([
                    'bet_coin' => ['required', 'numeric', 'gt:0', new CheckCoins(), new BettingLimit()],
                    'result' => 'required|gt:0|max:99|numeric'
                ],[
                    'result.required' => 'Please enter your prediction!',
                    'result.max' => 'Bet is allowed upto two digits'
                ]
            ); 
        }else{
            $request->validate([
                    'bet_coin' => ['required', 'numeric', 'gt:0', new CheckCoins(), new BettingLimit()],
                    'result' => ['required',new CheckLimit($request->type)]
                ],[
                    'result.required' => 'Please enter your prediction!'
                ]
            ); 
        }
       
        $request_object = $request->all();
        
        $check_for_enabled_match_event = MatchEvent::where('id',$request_object['match_event_id'])->first();
        if($check_for_enabled_match_event->status == 0){
            $create_bet_object = array(
                'user_id' => auth()->user()->id,
                'match_event_id' => $request_object['match_event_id'],
                'bet_coins' => $request_object['bet_coin'],
                'result' => $request_object['result'],
                'status' => 'NA',
                'type' => 'placed'
            );
            Bet::create($create_bet_object);
            
            //Update coins & debit from user
            $check_user_credit = Credit::where('user_id',auth()->user()->id)->latest('id')->first();
            $creat_credit_object = array(
                "user_id" => auth()->user()->id,
                "parent_id" => $check_user_credit->parent_id,
                "points" => $request_object['bet_coin'],
                "net_points" => $check_user_credit->net_points - $request_object['bet_coin'],
                "type" => 'bet-debit'
            );
            Credit::create($creat_credit_object);   
            return response()->json(['success'=>'Points updated']);
        }else{
            return response()->json([
                'errors'=>array("bet_coin"=>array('Betting is disabled!'))                     
            ],422);
        }                
    }

    public function list($match_id = null){
        $no_record_flag = 0;
        $get_bets = Bet::with("match_event.matchtypeevent.event_types")->whereHas("match_event", function ($query) use($match_id){
            $query->where("match_id",$match_id);           
        })->where("user_id",auth()->user()->id)->orderBy('created_at', 'DESC')->get();
        if(!$get_bets->isEmpty()){
            $no_record_flag = 1;
        }
        return view("backend.bets.list",compact('get_bets','no_record_flag'));
    }
}

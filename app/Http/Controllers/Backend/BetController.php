<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Rules\CheckCoins;
use App\Authorizable;
use App\Models\Bet;
use App\Models\Credit;

class BetController extends Controller
{
    use Authorizable;
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

    public function index(){
        exit("dasdasd");
    }

    public function store(Request $request){
        $request->validate([
                'bet_coin' => ['required', 'numeric', 'gt:0', new CheckCoins()] 
            ]
        ); 
        $request_object = $request->all();
        $create_bet_object = array(
            'user_id' => auth()->user()->id,
            'match_id' => $request_object['match_id'],
            'eventtype_id' => $request_object['eventtype_id'],
            'bet_coins' => $request_object['bet_coin'],
            'status' => 'NA',
            'type' => 'placed'
        );
        Bet::create($create_bet_object);

        //Update coins & debit from user
        $check_user_credit = Credit::where('user_id',auth()->user()->id)->latest()->first();
        $creat_credit_object = array(
            "user_id" => auth()->user()->id,
            "parent_id" => $check_user_credit->parent_id,
            "points" => $request_object['bet_coin'],
            "net_points" => $check_user_credit->net_points - $request_object['bet_coin'],
            "type" => 'debit'
        );
        Credit::create($creat_credit_object);   
        return response()->json(['success'=>'Points updated']);   
    }
}

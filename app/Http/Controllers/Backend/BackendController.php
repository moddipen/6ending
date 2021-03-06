<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Authorizable;
use App\Models\Match;
use App\Models\User;
use App\Models\Credit;
use App\Models\Bet;

class BackendController extends Controller
{
    // use Authorizable;
    public function __construct()
    {
        // Page Title
        // $this->module_title = 'Dashboard';

        // // module name
        // $this->module_name = 'dashboard';

        // // directory path of the module
        // $this->module_path = 'users';

        // // module icon
        // $this->module_icon = 'c-icon cil-people';

        // // module model name, path
        // $this->module_model = "App\Models\User";        
    }
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $total_coins = 0;
        $remaining_coins = 0;
        $user_coins = User::with("points")->where("id",auth()->user()->id)->first();
        if(!empty($user_coins)){
            if(!empty($user_coins->points)){
                $remaining_coins = $user_coins->points->net_points;
            }
        }
        $bet_coins = Credit::where("user_id",auth()->user()->id)->where("type","debit")->sum("points");
        $total_coins = Credit::where("user_id",auth()->user()->id)->where("type","credit")->sum("points");
        return view('backend.index',["remaining_coins"=>$remaining_coins,"bet_coins"=>$bet_coins,"total_coins"=>$total_coins]);
    }

    public function user_dashboard()
    {
        $total_coins = 0;
        $user_coins = User::with("points")->where("id",auth()->user()->id)->first();
        $remaining_coins = 0;
        if(!empty($user_coins)){
            if(!empty($user_coins->points)){
                $remaining_coins = $user_coins->points->net_points;
            }
        }

        $bet_coins = Bet::where("user_id",auth()->user()->id)->where("type","placed")->sum("bet_coins");
        if($remaining_coins > 0 || $bet_coins > 0){
            $total_coins = $remaining_coins + $bet_coins;
        }else{
            $total_coins = 0;
        }
        
        $matches = Match::with("matchtype")->where("status",0)->where('is_settled',0)->get();
        return view('backend.dashboard',["matches"=>$matches,"remaining_coins"=>$remaining_coins,"bet_coins"=>$bet_coins,"total_coins"=>$total_coins]);
    }
}

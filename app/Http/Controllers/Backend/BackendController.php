<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Authorizable;
use App\Models\Match;
use App\Models\User;

class BackendController extends Controller
{
    use Authorizable;
    public function __construct()
    {
        // Page Title
        $this->module_title = 'Dashboard';

        // module name
        $this->module_name = 'dashboard';

        // directory path of the module
        $this->module_path = 'users';

        // module icon
        $this->module_icon = 'c-icon cil-people';

        // module model name, path
        $this->module_model = "App\Models\User";
    }
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $total_coins = 0;
        $user_coins = User::with("points")->where("id",auth()->user()->id)->first();
        if(!empty($user_coins)){
            if(!empty($user_coins->points)){
                $total_coins = $user_coins->points->net_points;
            }
        }
        return view('backend.index',["total_coins"=>$total_coins]);
    }

    public function user_dashboard()
    {
        $total_coins = 0;
        $user_coins = User::with("points")->where("id",auth()->user()->id)->first();
        if(!empty($user_coins)){
            if(!empty($user_coins->points)){
                $total_coins = $user_coins->points->net_points;
            }
        }
        $matches = Match::with("matchtype")->where("status",0)->where('is_settled',0)->get();
        return view('backend.dashboard',["matches"=>$matches,"total_coins"=>$total_coins]);
    }
}

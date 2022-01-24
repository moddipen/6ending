<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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

    public function store(Request $request){
        $request->validate([
                'bet_coins' => 'required|numeric|gt:0|new CheckCoins()' 
            ]
        ); 
    }
}

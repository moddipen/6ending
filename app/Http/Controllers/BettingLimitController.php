<?php

namespace App\Http\Controllers\Backend;

use App\Authorizable;
use Exception;
use App\Models\BettingLimit;
use Flash;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BettingLimitController extends Controller
{
    use Authorizable;

    public function __construct()
    {
        // Page Title
        $this->module_title = 'BettingLimit';

        // module name
        $this->module_name = 'betcoins';

        // directory path of the module
        $this->module_path = 'betcoins';

        // module  mode name , path
        $this->module_model = "App\Models\BettingLimit";
    }

    public function store(Request $request){
        $request->validate([
            'minlimit' => 'required|numeric|gt:0',
            'maxlimit' => 'required|numeric|gt:0'
        ]);
        
        $bettinglimits = new BettingLimit;
        $bettinglimits -> $request -> minlimit;
        $bettinglimits -> $request -> maxlimit;
        $bettinglimits->save();
        Flash::success('Limits Set Successfully')->important();
        return redirect()->back(); 

    }
}

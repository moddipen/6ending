<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Match;

class BackendController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('backend.index');
    }

    public function user_dashboard()
    {
        $matches = Match::with("matchtype")->get();
        return view('backend.dashboard',["matches"=>$matches]);
    }
}

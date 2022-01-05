<?php

namespace App\Http\Controllers\Backend;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Matchtype;
use App\Models\Match;
use Illuminate\Support\Str;

class MatchController extends Controller
{
    public function __construct()
    {
        // Page Title
        $this->module_title = 'Matches';

        // module name
        $this->module_name = 'matches';

        // directory path of the module
        $this->module_path = 'matches';

        // module icon
        $this->module_icon = 'c-icon cil-task';

        // module model name, path
        $this->module_model = "App\Models\Match";
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $module_title = $this->module_title;
        $module_name = $this->module_name;
        $module_path = $this->module_path;
        $module_icon = $this->module_icon;
        $module_model = $this->module_model;
        $module_name_singular = Str::singular($module_name);

        $module_action = 'Create';

        $match_types = Matchtype::pluck('type','id');
        return view(
            "backend.$module_name.create",
            compact('match_types', 'module_name', 'module_path', 'module_icon', 'module_action', 'module_name_singular','module_title')
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'matchtype_id' => 'required',
            'team_1' => 'required|regex:/^[\pL\s]+$/u|max:255',
            'team_2' => 'required|regex:/^[\pL\s]+$/u|max:255',
            'status' => 'required'
        ],
        [
            'matchtype_id.required' => 'The Match Type field is required!'
        ]);   
        
        $request_object = $request->all();
        $create_record = array(
            "matchtype_id" => $request_object['matchtype_id'],
            "team_1" => $request_object['team_1'],
            "team_2" => $request_object['team_2'],
            "status" => $request_object['status']
        );
        Match::create($create_record);
        return redirect()->route('backend.matches.index')->withStatus(__('Record successfully created.'));          
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

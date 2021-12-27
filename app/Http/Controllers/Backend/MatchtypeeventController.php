<?php

namespace App\Http\Controllers\Backend;

use App\Authorizable;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Role;
use App\Models\Permission;

class MatchtypeeventController extends Controller
{
    use Authorizable;

    public function __construct()
    {
        // Page Title
        $this->module_title = 'Event Managment';

        // module name
        $this->module_name = 'eventmanagers';

        // directory path of the module
        $this->module_path = 'eventmanagers';

        // module icon
        $this->module_icon = 'c-icon cil-task';

        // module model name, path
        $this->module_model = "App\Models\Matchtypeevent";
    }

    public function index()
    {

    }
    /**
     * Show the form for creating a new resource.
     *
     * @return Response
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

        $roles = Role::get();
        $permissions = Permission::select('name', 'id')->get();
        
        return view(
            "backend.$module_name.create",
            compact('module_title', 'module_name', 'module_path', 'module_icon', 'module_action', 'module_name_singular', 'roles', 'permissions')
        );
    }

    public function store()
    {
        exit('asf');
    }
}
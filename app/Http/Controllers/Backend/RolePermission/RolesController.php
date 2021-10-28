<?php

namespace App\Http\Controllers\Backend\RolePermission;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolesController extends Controller
{
    
    public $user;

    public function __construct()
    {
        $this->middleware(function($request, $next){
              $this->user = Auth::guard('web')->user();
              return $next($request);
        });
    }
  
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (!$this->user->hasPermissionTo('roles.list') ) {
            return abort(403, 'Unauthoeized access to see the list!');
          
        }
       $roles = Role::all();
       return view('backend.pages.roles.index',compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (!$this->user->hasPermissionTo('roles.create') ) {
            return abort(403, 'Unauthoeized access to create role!');
          
        }
        $all_permissions = Permission::all();
        $permission_groups = User::getpermissionGroups();
        return view('backend.pages.roles.create',compact('all_permissions','permission_groups'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (!$this->user->hasPermissionTo('roles.create') ) {
            return abort(403, 'Unauthoeized access to create this!');
          
        }
        $request->validate([
            'name' => 'required',
        ]);

         $role =  Role::create(['name' => $request->name]);
      
         $permissions = $request->input('permissions');
         if (!empty($permissions)) {

            $role->syncPermissions($permissions);
            //$permission->syncRoles($roles);
         }
        return redirect()->route('roles.index')->with('success','Roles added has been successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      //  $role = Role::findById($id,'admin');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (!$this->user->hasPermissionTo('roles.edit') ) {
            return abort(403, 'Unauthoeized access to edit this !');
          
        }
        $all_permissions = Permission::all();
        $permission_groups = User::getpermissionGroups();
        $role = Role::findById($id);
        return view('backend.pages.roles.edit',compact('role','all_permissions','permission_groups'));
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
        if (!$this->user->hasPermissionTo('roles.update') ) {
            return abort(403, 'Unauthoeized access to update this!');
          
        }
        // Validation Data
        $request->validate([
            'name' => 'required|max:100|unique:roles,name,' . $id
        ], [
            'name.requried' => 'Please give a role name'
        ]);

        $role = Role::findById($id);
        $permissions = $request->input('permissions');

        if (!empty($permissions)) {
            $role->name = $request->name;
            $role->save();
            $role->syncPermissions($permissions);
        }

        return redirect()->route('roles.index')->with('success','Roles added has been successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (!$this->user->hasPermissionTo('roles.delete') ) {
            return abort(403, 'Unauthoeized access to delete this!');
          
        }
        $role = Role::findById($id);
        if (!is_null($role)) {
            $role->delete();
        }
        return redirect()->route('roles.index')->with('success','Roles deleted has been successfully!');
    }
}

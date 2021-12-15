<?php

namespace App\Http\Controllers\Backend\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class AdminDashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }


    public function index(){

        if (!request()->user()->hasPermissionTo('admin.dashboard') ) {
            return abort(403, 'Unauthoeized access to see the dashboard!');

        }

        $total_roles = count(Role::select('id')->get());
        $total_users = count(User::has('roles')->get());
        $total_permissions = count(Permission::select('id')->get());
        return view('backend.pages.dashboard.index',compact('total_roles','total_users','total_permissions'));
    }
}

<?php

namespace App\Http\Controllers\Backend\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class UsersController extends Controller
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
        if (!$this->user->hasPermissionTo('users.list') ) {
            return abort(403, 'Unauthoeized access to see the list!');

        }
       $users = User::has('roles')->get();
       return view('backend.pages.users.index',compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (!$this->user->hasPermissionTo('users.create')) {
            return abort(403, 'You are Unauthoeized access to create role!');

        }
        $roles = Role::all();
        return view('backend.pages.users.create',compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (!$this->user->hasPermissionTo('users.create')) {
            return abort(403, 'You are Unauthoeized access to create role!');

        }
        $request->validate([
            'name'     => 'required|max:100',
            'email'    => 'required|max:100|email|unique:users',
            'password' => 'required|max:100|min:8|confirmed',
            'image'    => 'nullable|image',
            'roles.*'    => 'required'
        ]);

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);

         //insert image
         if($request->hasFile('image')){
            $image = $request->file('image');
            $reImage = time().'.'.$image->getClientOriginalExtension();
            $dest = public_path('/images/user');
            $image->move($dest,$reImage);

            // save in database
            $user->image = $reImage;
         }

        $user->save();

        if ($request->roles) {
            $user->assignRole($request->roles);
        }else{
            return back()->with('error','Please assign role');
        }

        return redirect()->route('users.index')->with('success','Users added has been successfully!');
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

        if (!$this->user->hasPermissionTo('users.edit')) {
            return abort(403, 'You are Unauthoeized access to edit role!!');

        }
        $user  = User::find($id);
        if ($user->email == 'haider.cse7644@gmail.com') {
            return abort(403, 'You are Unauthoeized access to edit role!!');
        }
        $roles = Role::all();
        return view('backend.pages.users.edit',compact('roles','user'));
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
        if (!$this->user->hasPermissionTo('users.update')) {
            return abort(403, 'You are Unauthoeized access to update role!');

        }
        // Validation Data
        $request->validate([
            'name'     => 'required|max:100',
            'email'    => 'required|max:100|email|unique:users,email,' .$id,
            'password' => 'nullable|max:100|min:8|confirmed',
        ]);

        $user = User::find($id);
        if ($user->email == 'haider.cse7644@gmail.com') {
            return abort(403, 'You are Unauthoeized access to edit role!!');
        }
        $user->name = $request->name;
        $user->email = $request->email;
        if ($request->password) {
            $user->password = Hash::make($request->password);
        }
        if($request->hasFile('image')){
             //delete old user image
             if(File::exists('images/user/'.$user->image)){
                File::delete('images/user/'.$user->image);
            }
            $image = $request->file('image');
            $reImage = time().'.'.$image->getClientOriginalExtension();
            $dest = public_path('/images/user');
            $image->move($dest,$reImage);

            // save in database
            $user->image = $reImage;
         }

        $user->save();
        $user->roles()->detach();
        if ($request->roles) {
            $user->assignRole($request->roles);
        }

        return redirect()->route('users.index')->with('success','Users has been updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {


        if (!$this->user->hasPermissionTo('users.delete')) {
            return abort(403, 'you are unauthorized to delete role!');

        }

        $user = User::find($id);
        if ($user->email == 'haider.cse7644@gmail.com') {
            return abort(403, 'You are Unauthoeized access to edit role!!');
        }
        if (!is_null($user)) {

             //delete user image
            if(File::exists('images/user/'.$user->image)){
                File::delete('images/user/'.$user->image);
            }
            $user->delete();
        }
        return redirect()->route('users.index')->with('success','Users deleted has been successfully!');
    }


    //update user
    public function updateSingleUser($id){
        $user = User::find($id);
        return view('backend.pages.users.update',compact('user'));
    }

    public function updateUserPost(Request $request,$id){
          // Validation Data
          $request->validate([
            'name'     => 'required|max:100',
            'email'    => 'required|max:100|email|unique:users,email,' .$id,
            'password' => 'nullable|max:100|min:8|confirmed',
        ]);

        $user = User::find($id);
        $user->name = $request->name;
        $user->email = $request->email;
        if($request->password){
            $user->password = $request->password;
        }

        if($request->hasFile('image')){
            //delete old user image
            if(File::exists('images/user/'.$user->image)){
               File::delete('images/user/'.$user->image);
           }
           $image = $request->file('image');
           $reImage = time().'.'.$image->getClientOriginalExtension();
           $dest = public_path('/images/user');
           $image->move($dest,$reImage);

           // save in database
           $user->image = $reImage;
        }

        $user->save();
        return redirect()->route('admin.dashboard')->with('success','Users has been updated successfully!');
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Crypt;

class UserController extends Controller
{
    public function create()
    {
        $roles = Role::all();
        return view('users.create', compact('roles'));
    }

    public function store(Request $request)
    {
        $user = new user;
        $user->name =  $request->name;
        $user->username =  $request->username;
        $user->email =  $request->email;
        $user->password = Crypt::encryptString($request->password);
	
        

        $roleId = $request->input('role'); // retrieve the selected role from the form
        $role = Role::find($roleId); // retrieve the role by name
        $user->role_id = $role->id;
        // $user->assignRole($role->id);

        $user->save();

        return redirect()->back()->with('message', 'Record added successfully');
    }

    public function edit(string $id)
    {
        $user = User::find($id);
        return view('users.edit', compact('user')); 
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'name'=>'required',
            'username'=>'required',
            'email'=>'required',
        ]); 
        $user = User::find($id);
        // getting values from the blade template form
	    $user->name = $request->name;
	    $user->username = $request->username;
	    $user->email = $request->email;
	
        $user->save();
 
        return redirect()->back()->with('message', 'Record updated successfully');
    }

    public function destroy(string $id)
    {
        User::destroy($id);
        return redirect()->back()->with('message', 'Record deleted successfully');
    }

    public function index()
    {
        Paginator::useBootstrap();
        $user = User::orderBy('id','DESC')->paginate('5');
        
        return view('users.index',compact('user'));
    }
}



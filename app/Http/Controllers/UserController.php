<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Roles;
use Hash;

class UserController extends Controller
{
    public function index()
    {
        $user = User::orderBy('id','DESC')->paginate('5');
        
        return view('users.index',compact('user'));
    }

    public function create()
    {
        $roles = Roles::get();

        return view('users.create', compact('roles'));
    }

    public function store(Request $request)
    {
        $user = new User;
        $user->name =  $request->name;
        $user->username =  $request->username;
        $user->email =  $request->email;
        $user->password = Hash::make($request->password);

        $user->role_id = $request->role_id;

        $user->save();

        return redirect()->route('users.index')->with('message', 'Record added successfully');
    }

    public function edit($id)
    {
        $user = User::find($id);
        $roles = Roles::all();
        return view('users.edit', compact('user','roles')); 
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name'=>'required',
            'username'=>'required',
            'email'=>'required',
            'role_id' => 'required'
        ]); 
        $user = User::find($id);
        // getting values from the blade template form
	    $user->name = $request->name;
	    $user->username = $request->username;
	    $user->email = $request->email;
        if(!empty($request->password))
        {
            $user->password = Hash::make($request->password);
        }
	
        $user->update();
 
        return redirect()->back()->with('message', 'Record updated successfully');
    }

    public function destroy($id)
    {
        User::destroy($id);
        return redirect()->back()->with('message', 'Record deleted successfully');
    }
}



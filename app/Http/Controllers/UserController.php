<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Crypt;

class UserController extends Controller
{
    public function create()
    {
        return view('users.create');
    }

    public function store(Request $request)
    {
        $user = new user;
        $user->name =  $request->name;
        $user->username =  $request->username;
        $user->email =  $request->email;
        $user->password = Crypt::encryptString($request->password);
	
        

        $roleName = $request->input('role'); // retrieve the selected role from the form
        
        $role = Role::findByName($roleName); // retrieve the role by name
        $user->assignRole($role);

        $user->save();

        return redirect()->back()->with('message', 'Record added successfully');
    }
}

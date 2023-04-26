<?php

namespace App\Http\Controllers;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\Roles;
use App\Models\Permissions;
use Illuminate\Http\Request;




class RolesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roles = Roles::get();

        return view('roles.index', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $permissions = Permissions::select('permissions.id','permissions.name','modules.title','permissions.module_id')
                                ->leftjoin('modules','permissions.module_id','=','modules.id')
                                ->orderBy('modules.title','ASC')
                                ->get();

        return view('roles.create', compact('permissions'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $role = Role::create(['name' => $request->input('name')]);

        $role->syncPermissions($request->input('permission_id'));

        if($role){
            return redirect()->route('roles.index')->with('success','New Role has been created successfully :)');
        }else{
            return redirect()->route('permissions.index')->with('error','Something went wrong. Please try creating a new role again :(');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Roles  $roles
     * @return \Illuminate\Http\Response
     */
    public function show(Roles $roles)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Roles  $roles
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $permissions = Permissions::select('permissions.id','permissions.name','modules.title','permissions.module_id')
                                ->leftjoin('modules','permissions.module_id','=','modules.id')
                                ->orderBy('modules.title','ASC')
                                ->get();

        $role = Roles::find($id);

        $selper = Permissions::select('permissions.id','roles.name')
                           ->leftjoin('role_has_permissions','role_has_permissions.permission_id','=','permissions.id')
                           ->leftjoin('roles','roles.id','=','role_has_permissions.role_id')
                           ->where('roles.id','=',$id)
                           ->get();

        return view('roles.edit', compact('permissions','selper','id','role'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Roles  $roles
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $role = Role::find($id);

        $role->syncPermissions($request->input('permission_id'));

        if($role){
            return redirect()->route('roles.index')->with('success','Role has been updated successfully :)');
        }else{
            return redirect()->route('permissions.index')->with('error','Something went wrong. Please try updating a role again :(');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Roles  $roles
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $DeleteData = Role::findOrFail($id);

        if($DeleteData->delete()){
            return redirect()->route('roles.index')->with('success','Role has been deleted successfully :)','Success');
        }else{
            return redirect()->route('permissions.index')->with('error','Something went wrong. Please try deleting a role again :(','Oops');
        }
    }
}

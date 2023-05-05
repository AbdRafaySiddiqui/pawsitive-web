<?php

namespace App\Http\Controllers;

use App\Models\Permissions;
use App\Models\Modules;
use Illuminate\Http\Request;

class PermissionsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $all = Permissions::select('permissions.name','modules.title','permissions.id')
                        ->leftjoin('modules','modules.id','=','permissions.module_id')
                        ->get();
        return view('permissions.index', compact('all'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $modules = Modules::get();
        return view('permissions.create', compact('modules'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $new = new Permissions;
        $new->name = $request->name;
        $new->module_id = $request->module_id;

        if($new->save()){
            return redirect()->route('permissions.index')->with('success','New Permission has been created successfully!');
        }else{
            return redirect()->route('permissions.index')->with('danger','Something went wrong. Please try creating a new permission again.');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Permissions  $permissions
     * @return \Illuminate\Http\Response
     */
    public function show(Permissions $permissions)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Permissions  $permissions
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $perm = Permissions::select('modules.title','permissions.module_id','permissions.name','permissions.id')
                           ->leftjoin('modules','modules.id','=','permissions.module_id')
                           ->where('permissions.id','=',$id)
                           ->first();

        $modules = Modules::get();

        return view('permissions.edit', compact('perm','modules'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Permissions  $permissions
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $edit = Permissions::find($id);
        $edit->name = $request->name;
        $edit->module_id = $request->module_id;

        if($edit->update()){
            return redirect()->route('permissions.index')->with('success','Permission has been updated successfully!');
        }else{
            return redirect()->route('permissions.index')->with('danger','Something went wrong. Please try updating a new permission again.');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Permissions  $permissions
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $del = Permissions::find($id);
        
        if($del->delete()){
            return redirect()->route('permissions.index')->with('success','Permission has been deleted successfully!');
        }else{
            return redirect()->route('permissions.index')->with('danger','Something went wrong. Please try deleting a permission again.');
        }
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AKCGroup;

class akc_group extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $akcs = akcgroup::get();
        
        return view('akc_groups.index',compact('akcs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('akc_groups.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $new = new akcgroup;
        $new->name = $request->name;

        $new->save();
        return redirect()->back()->with('message', 'Record added successfully');

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $akc = akcgroup::find($id);
        return view('akc_groups.edit', compact('akc'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name'=>'required',
        ]); 
        $akc = akcgroup::find($id);
        // Getting values from the blade template form
	    $akc->name = $request->name;

        $akc->save();
 
        return redirect()->back()->with('message', 'Record updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        akcgroup::where('id','=',$id)->delete();
        
        return redirect()->back()->with('message', 'Record deleted successfully');
    }
}

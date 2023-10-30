<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\FCIGroup;

class FCIGroupController extends Controller
{

    function __construct()
    {
        $this->middleware('permission:fci_groups-list');
        $this->middleware('permission:fci_groups-create', ['only' => ['create','store']]);
        $this->middleware('permission:fci_groups-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:fci_groups-delete', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $fcis = FCIGroup::get();
        
        return view('fci_groups.index',compact('fcis'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('fci_groups.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $new = new FCIGroup;
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
        $fci = FCIGroup::find($id);
        return view('fci_groups.edit', compact('fci'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name'=>'required',
        ]); 
        $fci = FCIGroup::find($id);
        // Getting values from the blade template form
	    $fci->name = $request->name;

        $fci->save();
 
        return redirect()->back()->with('message', 'Record updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        FCIGroup::where('id','=',$id)->delete();
        
        return redirect()->back()->with('message', 'Record deleted successfully');
    }
}

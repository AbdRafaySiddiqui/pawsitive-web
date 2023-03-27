<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Breeds;

class BreedsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $breed = Breeds::get();
        
        return view('breeds.index',compact('breed'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {


        return view('breeds.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $breeds = new Breeds;
        $breeds->name =  $request->name;
	
        $breeds->save();
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
        $breed = Breeds::find($id);
        return view('breeds.edit', compact('breed')); 
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name'=>'required',
        ]); 
        $breeds = Breeds::find($id);
        // Getting values from the blade template form
	    $breeds->name = $request->name;

	
        $breeds->save();
 
        return redirect()->back()->with('message', 'Record updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Breeds::where('id','=',$id)->update(array('status' => 'Inactive'));
        
        return redirect()->back()->with('message', 'Record deleted successfully');
    }
}

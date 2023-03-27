<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\dogs;

class dogsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $dog = dogs::get();
        
        return view('dogs.index',compact('dog'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dogs.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $dogs = new dogs;
        $dogs->dog_name =  $request->dog_name;
        $dogs->dob =  $request->dob;
        $dogs->reg_no =  $request->reg_no;
        $dogs->microchip =  $request->microchip;
        $dogs->gender =  $request->gender;
        $dogs->show_title =  $request->show_title;
        $dogs->achievements =  $request->achievements;
	
        $dogs->save();
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
        $dog = dogs::find($id);
        return view('dogs.edit', compact('dog')); 
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'dog_name'=>'required',
            'dob'=>'required',
            'reg_no'=>'required',
            'microchip'=>'required',
            'gender'=>'required',
            'show_title'=>'required',
            'achievements'=>'required'
        ]); 
        $dog = dogs::find($id);
        // Getting values from the blade template form
	    $dog->dog_name = $request->dog_name;
	    $dog->dob = $request->dob;
	    $dog->reg_no = $request->reg_no;
	    $dog->microchip = $request->microchip;
	    $dog->gender = $request->gender;
	    $dog->show_title = $request->show_title;
	    $dog->achievements = $request->achievements;
	
        $dog->save();
 
        return redirect()->back()->with('message', 'Record updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        dogs::destroy($id);
        return redirect()->back()->with('message', 'Record deleted successfully');
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\dogs;
use App\Models\dog_real_parent;

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
        $maleDogs = dogs::where('gender', '=', 'Male')->get();
        $femaleDogs = dogs::where('gender', '=', 'Female')->get();
        return view('dogs.create',compact('maleDogs', 'femaleDogs'));
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
        $dogs->microchip =  $request->microchip;
        $dogs->gender =  $request->gender;
        $dogs->show_title =  $request->show_title;
        $dogs->achievements =  $request->achievements;
        $dogs->breed_id = $request->breed_id;
        $dogs->save();

        $new_dog_id = $dogs->id;

        $parent = new dog_real_parent;
        $parent->dog_id = $new_dog_id;
        $parent->sire_id = $request->sire_id;
        $parent->dam_id = $request->dam_id;
        $parent->save();
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
        $total_breeds = Breeds::get();
        return view('dogs.edit', compact('dog','total_breeds')); 
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
            'achievements'=>'required',
            'breed_id'=>'required'
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
	    $dog->breed_id = $request->breed_id;
	
        $dog->save();
 
        return redirect()->back()->with('message', 'Record updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Dogs::where('id',$id)->update(array('status' => 'Inactive'));
        return redirect()->back()->with('message', 'Record deleted successfully');
    }
    
    public function storeMale(Request $request)
    {
        $dogs = new dogs;
        $dogs->dog_name =  $request->dog_name;
        $dogs->dob =  $request->dob;
        $dogs->reg_no =  $request->reg_no;
        $dogs->microchip =  $request->microchip;
        $dogs->gender =  "Male";
        $dogs->title =  $request->show_title;
        $dogs->achievements =  $request->achievements;
	
        $dogs->save();
        return redirect()->back()->with('message', 'Record added successfully');
    }

    public function storeFemale(Request $request)
    {
        $dogs = new dogs;
        $dogs->dog_name =  $request->fe_dog_name;
        $dogs->dob =  $request->fe_dob;
        $dogs->reg_no =  $request->fe_reg_no;
        $dogs->microchip =  $request->fe_microchip;
        $dogs->gender =  "Female";
        $dogs->title =  $request->fe_show_title;
        $dogs->achievements =  $request->fe_achievements;
	
        $dogs->save();
        return redirect()->back()->with('message', 'Record added successfully');
    }
    

}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Dogs;
use App\Models\Breeds;
use App\Models\Event_Result;
use App\Models\Judges;
use App\Models\DogsRealParent;
use App\Models\Events;
use League\Csv\Writer;

class EventResultsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $dogs = Dogs::get();
        $total_breeds = Breeds::get();
        $total_judges = Judges::get();
        $maleDogs = Dogs::where('gender', '=', 'Male')->get();
        $femaleDogs = Dogs::where('gender', '=', 'Female')->get();
        $Events = Events::all();
        
        return view('event_results.create',compact('Events','maleDogs', 'femaleDogs','dogs','total_breeds','total_judges'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $event_result = new Event_Result;
        $event_result->dog_id =  $request->dog_id;
        $event_result->grading =  $request->grade;
        $event_result->place =  $request->place;
        $event_result->judge =  $request->judge;
        $event_result->save();
        return redirect()->back()->with('message', 'Record added successfully');
        //
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }
    public function dog_submit(Request $request)
    {
        
        // return redirect()->back()->with('message', 'Record added successfully');

        $request->validate([
            'dog_name'=>'required',
            'dob'=>'required',
            'reg_no'=>'required',
            'microchip'=>'required',
            'gender'=>'required',
            'show_title'=>'required',
            'achievements'=>'required',
       
        ]); 
    
       
        
        $dogs = new Dogs;
        $dogs->dog_name =  $request->dog_name;
        $dogs->dob =  $request->dob;
        $dogs->reg_no =  $request->reg_no;
        $dogs->microchip =  $request->microchip;
        $dogs->gender =  $request->gender;
        $dogs->show_title =  $request->show_title;
        $dogs->achievements =  $request->achievements;
        $dogs->breed_id = $request->breed_id;
        $dogs->save();
        $new_dog_id = $dogs->id;

        $parent = new DogsRealParent;
        $parent->dog_id = $new_dog_id;
        $parent->sire_id = $request->sire_id;
        $parent->dam_id = $request->dam_id;
        $parent->save();
        return response()->json([
            'success' => true,
            'message' => 'Form submitted successfully',
            'response' =>   $dogs
        ]);
    
    
    
    
    
    } 

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

}

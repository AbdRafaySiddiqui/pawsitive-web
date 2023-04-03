<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Breeds;
use App\Models\Clubs;
use App\Models\Countries;
use App\Models\Species;

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


        $clubs = Clubs::where('status','=','Active')->get();

        $species = Species::where('status','=','Active')->get();

        $countries = Countries::get();

        $adapt_bones = array(
                        'Suited To Apartment Living',
                        'Good For Novice Owners',
                        'Sensitivity Level',
                        'Tolerates Being Alone',
                        'Tolerates Cold Weather',
                        'Tolerates Hot Weather'
        );

        $friendly_bones = array(
                        'Affectionate With Family',
                        'Kid-Friendly',
                        'Dog Friendly',
                        'Friendly Towards Strangers'
        );

        $hg_bones = array(
                        'Amount Of Shedding',
                        'Drooling Potential',
                        'Easy To Groom',
                        'General Health',
                        'Potential For Weight Gain',
                        'Size'
        );

        $train_bones = array(
                        'Easy To Train',
                        'Intelligence',
                        'Potential For Mouthiness',
                        'Prey Drive',
                        'Tendency to Bark or Howl',
                        'Wanderlust Potential'
        );

        $physical_bones = array(
                        'Energy Level',
                        'Intensity',
                        'Exercise Needs',
                        'Potential for Playfulness'
        );

        $adapt = array('0.0','0.1','0.2','0.3','0.4','0.5','0.6','0.7','0.8','0.9','1.0','1.1','1.2','1.3','1.4','1.5','1.6','1.7','1.8','1.9','2.0','2.1','2.2','2.3','2.4','2.5','2.6','2.7','2.8','2.9','3.0','3.1','3.2','3.3','3.4','3.5','3.6','3.7','3.8','3.9','4.0','4.1','4.2','4.3','4.4','4.5','4.6','4.7','4.8','4.9','5.0');

        $friendly = array('0.0','0.1','0.2','0.3','0.4','0.5','0.6','0.7','0.8','0.9','1.0','1.1','1.2','1.3','1.4','1.5','1.6','1.7','1.8','1.9','2.0','2.1','2.2','2.3','2.4','2.5','2.6','2.7','2.8','2.9','3.0','3.1','3.2','3.3','3.4','3.5','3.6','3.7','3.8','3.9','4.0','4.1','4.2','4.3','4.4','4.5','4.6','4.7','4.8','4.9','5.0');

        $h_g = array('0.0','0.1','0.2','0.3','0.4','0.5','0.6','0.7','0.8','0.9','1.0','1.1','1.2','1.3','1.4','1.5','1.6','1.7','1.8','1.9','2.0','2.1','2.2','2.3','2.4','2.5','2.6','2.7','2.8','2.9','3.0','3.1','3.2','3.3','3.4','3.5','3.6','3.7','3.8','3.9','4.0','4.1','4.2','4.3','4.4','4.5','4.6','4.7','4.8','4.9','5.0');

        $train = array('0.0','0.1','0.2','0.3','0.4','0.5','0.6','0.7','0.8','0.9','1.0','1.1','1.2','1.3','1.4','1.5','1.6','1.7','1.8','1.9','2.0','2.1','2.2','2.3','2.4','2.5','2.6','2.7','2.8','2.9','3.0','3.1','3.2','3.3','3.4','3.5','3.6','3.7','3.8','3.9','4.0','4.1','4.2','4.3','4.4','4.5','4.6','4.7','4.8','4.9','5.0');

        $physical = array('0.0','0.1','0.2','0.3','0.4','0.5','0.6','0.7','0.8','0.9','1.0','1.1','1.2','1.3','1.4','1.5','1.6','1.7','1.8','1.9','2.0','2.1','2.2','2.3','2.4','2.5','2.6','2.7','2.8','2.9','3.0','3.1','3.2','3.3','3.4','3.5','3.6','3.7','3.8','3.9','4.0','4.1','4.2','4.3','4.4','4.5','4.6','4.7','4.8','4.9','5.0');

        return view('breeds.create', compact('species','countries','adapt','friendly','h_g','train','physical','adapt_bones','friendly_bones','hg_bones','train_bones','physical_bones','clubs'));
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

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Clubs;
use App\Models\Cities;
use App\Models\Breeds;
use App\Models\Events;
use App\Models\Judges;
use App\Models\Countries;
use Illuminate\Pagination\Paginator;

class EventsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        Paginator::useBootstrap();
        $event = Events::with('cities_name','country_name','club_name','judge_name')->orderBy('id','DESC')->paginate('5');
       
        return view('events/index', compact('event'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $total_clubs = Clubs::get();
        $total_cities = Cities::get();
        $total_countries = Countries::get();
        $total_breeds = Breeds::get();
        $judges = Judges::all();
        return view('events.create',compact('total_clubs','total_cities','total_breeds','total_countries','judges'));
       
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    { 
        $events = new Events;
        $events->name =  $request->name;
	    $events->club_id = $request->club_id;
	    $events->city = $request->city;
	    $events->country = $request->country;
	    $events->date = $request->date;
	    $events->judge_id = $request->judge_id;
        $events->save();
        
        return redirect()->back()->with('message', 'Record added successfully',compact('request'));
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
        $events = Events::find($id);
        $total_clubs = Clubs::get();
        $total_countries = Countries::get();
        $total_cities = Cities::get();
        $judges = Judges::get();
        return view('events/edit', compact('events','total_countries','total_cities','total_clubs','judges'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $request->validate([
            'event_name'=>'required',
            'club_id'=>'required',
            'city'=>'required',
            'country'=>'required',
            'date'=>'required',
            'judge_id'=>'required',
        ]); 
        $events = Events::find($id);

        // Getting values from the blade template form
        $events->name =  $request->event_name;
	    $events->club_id = $request->club_id;
	    $events->city = $request->city;
	    $events->country = $request->country;
	    $events->date = $request->date;
	    $events->judge_id = $request->judge_id;
        $events->update();
 
        return redirect()->back()->with('message', 'Record updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        Events::where('id',$id)->update(array('status' => 'Inactive'));
        return redirect()->back()->with('message', 'Record Permenantly Deleted!');
    }


// modal data submit 
public function submitForm(Request $request)
{

    $request->validate([
        'full_name'=>'required',
        'position_in_club'=>'required',
        'description'=>'required',
   
    ]); 

    if($request->hasFile('img') && $request->hasFile('sig') ) {
        $imageName = time().'.'.request()->img->getClientoriginalName();
        request()->img->move(public_path('judge_images'), $imageName);
        
        $imagesig = time().'.'.request()->sig->getClientoriginalName();
        request()->sig->move(public_path('judge_signatures'), $imagesig);
    }
    else {
        $imageName = "";
        $imagesig = "";
    }
    
    $create =  new Judges;
    $create->full_name = $request->full_name;
    $create->position_in_club = $request->position_in_club;
    $create->description = htmlentities($request->description);
    $create->image = $imageName;
    $create->signature = $imagesig;
    $link = str_replace(" ", "-", $request->full_name);
    $create->url_link = $link; 
    $create->save();

    return response()->json([
        'success' => true,
        'message' => 'Form submitted successfully',
        'response' =>   $create
    ]);



}

}

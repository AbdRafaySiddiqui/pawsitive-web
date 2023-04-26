<?php

namespace App\Http\Controllers;
use App\Models\Clubs;
use App\Models\Countries;
use App\Models\Cities;
use Illuminate\Pagination\Paginator;
use League\Csv\Writer;

use Illuminate\Http\Request;

class ClubsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        Paginator::useBootstrap();
        $club = Clubs::orderBy('id','DESC')->paginate('5');
        
        return view('club.index',compact('club'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $total_countries = Countries::get();
        $total_cities = Cities::get();
       

        return view('club.create',compact('total_cities','total_countries'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if($request->hasFile('img')) {
            $imageName = time().'.'.request()->img->getClientoriginalName();
            request()->img->move(public_path('club_images'), $imageName);
        }
        else {
            $imageName = "";
        }
        $club = new Clubs;

        $club->name =  $request->name;
	    $club->country = $request->country;
	    $club->city = $request->city;
	    $club->email = $request->email;
	    $club->phone = $request->phone;
	    $club->affiliation = $request->affiliation;
        $club->image = $imageName;
        $club->save();
        
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
        $et_club = Clubs::find($id);
        $total_countries = Countries::get();
        $total_cities = Cities::get();

        return view('club.edit', compact('et_club','total_cities','total_countries')); 
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name'=>'required',
            'email'=>'required',
            'city'=>'required',
            'country'=>'required',
            'phone'=>'required',
            'affiliation'=>'required'
    
        ]); 
        if($request->hasFile('image')) {
            $imageName = time().'.'.request()->img->getClientoriginalName();
            request()->img->move(public_path('club_images'), $imageName);
        }
        else {
            $imageName = "";
        }
        
        $club = Clubs::find($id);
        // Getting values from the blade template form
	    $club->name = $request->name;
	    $club->email = $request->email;
	    $club->city = $request->city;
	    $club->country = $request->country;
	    $club->phone = $request->phone;
        $club->affiliation = $request->affiliation;
        $club->image = $imageName;
        $club->save();

        // try {
        //     $club->update();
        // } catch (\Exception $e) {
        //     return redirect()->back()->with('error', 'An error occurred while updating the record. Please try again later.');
        // }
    
        return redirect()->back()->with('message', 'Record updated successfully');
    
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Clubs::where('id',$id)->update(array('status' => 'Inactive'));
        
        return redirect()->back()->with('message', 'Record deleted successfully');
    }

    public function club_details($clubId)
      {
          $club = Clubs::find($clubId);
          
          if (!$club) {
              return response()->json(['error' => 'Club not found'], 404);
          }
          
        //   return response()->json($club);
        return $club;
      }

      
public function download()
{
    // Fetch data from the database
    $clubs = Clubs::all();

    // Create a new CSV file and write the data to it
    $csv = Writer::createFromString('');
    $csv->insertOne(['name', 'country', 'city', 'email', 'phone', 'affiliation', 'image']);

    foreach ($clubs as $club) {
        $csv->insertOne([$club->name, $club->country, $club->city, $club->email, $club->phone, $club->affiliation, $club->image]);
    }

    // Download the CSV file
    $headers = [
        'Content-Type' => 'text/csv',
        'Content-Disposition' => 'attachment; filename="clubs.csv"',
    ];

    return response($csv->getContent(), 200, $headers);
}

}

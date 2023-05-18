<?php

namespace App\Http\Controllers;
use App\Models\Clubs;
use App\Models\Countries;
use App\Models\Cities;
use Illuminate\Pagination\Paginator;
use League\Csv\Writer;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;

class ClubsController extends Controller
{

    function __construct()
    {
        $this->middleware('permission:club-list');
        $this->middleware('permission:club-create', ['only' => ['create','store']]);
        $this->middleware('permission:club-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:club-delete', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        Paginator::useBootstrap();
        $club = Clubs::where('status', 'Active')->orderBy('id', 'DESC')->paginate(10);
        
        return view('club.index',compact('club'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
    $total_cities = Cities::get();
    $countries = Countries::get();

    // $countries = DB::table('countries')->select('idCountry', 'countryName')->get()->pluck('countryName', 'idCountry'); 

    return view('club.create',compact('countries'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if($request->hasFile('img')) {
            $imageName = time().'.'.request()->img->getClientoriginalName();
            request()->img->move(storage_path('app/public/club_images'), $imageName);
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
	    $club->address = $request->address;
	    $club->affiliation = $request->affiliation;
	    $club->website = $request->website;
        $club->image = $imageName;
        $res = $club->save();

        if($res)
        {
            return redirect()->back()->with('message', 'Record added successfully');
        }
        else
        {
        return redirect()->back()->with('message', 'Error occured');
        }
        
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
    public function edit($id)
    { 
        $et_club = Clubs::find($id);
        $countries = Countries::get();
        $total_cities = Cities::get();

        return view('club.edit', compact('et_club','total_cities','countries')); 
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'city' => 'required',
            'country' => 'required',
            'phone' => 'required'
        ]); 
        $club = Clubs::find($id);
        if (!$club) {
            return redirect()->back()->with('error', 'The club could not be found.');
        }
        // Getting values from the blade template form
        $club->name = $request->name;
        $club->email = $request->email;
        $club->city = $request->city;
        $club->country = $request->country;
        $club->phone = $request->phone;
        $club->affiliation = $request->affiliation;
        $club->save();

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

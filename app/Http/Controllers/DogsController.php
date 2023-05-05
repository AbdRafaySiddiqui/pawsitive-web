<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Dogs;
use App\Models\Clubs;
use App\Models\Breeds;
use Illuminate\Pagination\Paginator;
use League\Csv\Writer;
use Illuminate\Support\Str;

use App\Models\DogsRealParent;
use DB;

class DogsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        Paginator::useBootstrap();
        $dog = Dogs::orderBy('id','DESC')->paginate('5');
        
        return view('dogs.index',compact('dog'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $total_breeds = Breeds::get();
        $maleDogs =   DB::table('dogs')->select(DB::raw('dogs.id,dogs.dog_name as dog_name,gender'))
        ->where('gender', '=', 'Male')
         ->paginate(10);
        
         $femaleDogs =   DB::table('dogs')->select(DB::raw('dogs.id,dogs.dog_name as dog_name,gender'))
        ->where('gender', '=', 'Female')
        ->paginate(10);
        $total_clubs = Clubs::get();
        return view('dogs.create',compact('maleDogs', 'femaleDogs','total_breeds','total_clubs'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $dogs = new Dogs;
        $dogs->dog_name =  $request->dog_name;
        $dogs->dob =  $request->dob;
        $dogs->reg_no =  $request->reg_no;
        $dogs->reg_with =  $request->reg_with;
        $dogs->microchip =  $request->microchip;
        $dogs->gender =  $request->gender;
        $dog->class = $request->class;
        $dogs->show_title =  $request->show_title;
        $dogs->achievements =  $request->achievements;
        $dogs->breed_id = $request->breed_id;
        $dogs->ref_id = (string) Str::uuid();
        $dogs->save();

        // $new_dog_id = $dogs->id;
        $new_ref_id = $dogs->ref_id;

        $parent = new DogsRealParent;
        $parent->dog_id = $new_ref_id;
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
        $dog = Dogs::find($id);
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
        $dog = Dogs::find($id);
        // Getting values from the blade template form
	    $dog->dog_name = $request->dog_name;
	    $dog->dob = $request->dob;
	    $dog->reg_no = $request->reg_no;
	    $dog->microchip = $request->microchip;
	    $dog->class = $request->class;
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
        $dogs = new Dogs;
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
        $dogs = new Dogs;
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

    public function download()
    {
        // Fetch data from the database
        $dogs = Dogs::all();

        // Create a new CSV file and write the data to it
        $csv = Writer::createFromString('');
        $csv->insertOne(['dog_name', 'is_champion', 'dob', 'gender', 'microchip', 'reg_no', 'achievements', 'show_title', 'breed_id', 'status']);

        foreach ($dogs as $dog) {
            $csv->insertOne([
                $dog->dog_name,
                $dog->is_champion,
                $dog->dob,
                $dog->gender,
                $dog->microchip,
                $dog->reg_no,
                $dog->achievements,
                $dog->show_title,
                $dog->breed_id,
                $dog->status,
            ]);
        }

        // Download the CSV file
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="dogs.csv"',
        ];

        return response($csv->getContent(), 200, $headers);
    }
    

}

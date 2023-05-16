<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Dogs;
use App\Models\Breeds;
use App\Models\Clubs;
use App\Models\Event_Result;
use App\Models\EventJudges;
use App\Models\Judges;
use App\Models\DogsRealParent;
use App\Models\DogClass;
use App\Models\DogOwner;
use App\Models\Events;
use League\Csv\Writer;
use App\Models\User;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Str;
use DB;

class EventResultsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        Paginator::useBootstrap();
        $event = Events::where('status','=','Active')->orderBy('id','DESC')->paginate('5');
       
        return view('event_results.index', compact('event'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $dogs=  DB::table('dogs')
        ->select(DB::raw('id,dog_name, status'))
          ->where('status','=',"Active")
      ->paginate(10);
      $total_clubs = Clubs::get();
      $femaleDogs =  DB::table('dogs')
        ->select(DB::raw('id,dog_name'))
          ->where('gender', '=', "Female")
      ->get();
      $total_owners = User::select('id','username')->get();
        $total_breeds = Breeds::get();
        $total_judges = Judges::get();
        $dog_class = DogClass::get();
        $data = EventJudges::get();
        $maleDogs = DB::table('dogs')
        ->select(DB::raw('id,dog_name'))
          ->where('gender', '=', "Male")
      ->get();
     
        $Events = Events::where('status', 'active')->get();
        
        return view('event_results.create',compact('Events','maleDogs', 'femaleDogs','dogs','total_breeds','total_judges','dog_class' ,'data','total_owners','total_clubs'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $dog_id = $request->input('dog_id');
        $grading = $request->input('grading');
        $place = $request->input('place');
        $judge = $request->input('judge');
        $award_id = $request->input('awards');
        $event_id = $request->input('event_id');
        $breed_id = $request->input('breed_id');
        $class = $request->input('class');
    
        foreach ($dog_id as $key => $value) {
     $event_result = new Event_Result;
            $event_result->dog_id = $value;
            
            $gender = Dogs::select('dogs.gender As gender')
          ->where('dogs.id','=',$value)
          ->first();
          
            $event_result->grading = $grading[$key];
            $event_result->place = $place[$key];
               $judge_one = EventJudges::select('event_id','judge_id')
                ->where('event_id','=',$event_id)
                ->get();
                if(count($judge_one) ==1){
            $event_result->judge = $judge_one[0]->judge_id;
    
            }else{
            $event_result->judge = $judge[$key];
    
            }
            if($gender->gender== null){
                 $event_result->gender = 'Male';
            }else{
                $event_result->gender = $gender->gender;
            }
            $event_result->award_id = $award_id[$key];
            
            $event_result->event_id = $event_id;
            $event_result->breed_id = $breed_id;
            $event_result->class = $class;
            $event_result->save();
        }
    
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
    public function edit($id)
    {
        $total_breeds = Breeds::get();
        $event = Events::find($id);
        $classes = Event_Result::select('class')->where('event_id', $id)->distinct()->get();
        
        return view('event_results.edit', compact('event','classes','total_breeds'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'award'=>'required',
            'grading'=>'required',
            'place'=>'required',
            'judge'=>'required',
        ]); 
        $event_result = Event_Result::find($id);

        // Getting values from the blade template form
        $event_result->award_id =  $request->award;
	    $event_result->grading = $request->grading;
	    $event_result->place = $request->place;
	    $event_result->judge = $request->judge;
        $event_result->update();
 
        return redirect()->back()->with('message', 'Record updated successfully');
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
    
       
        
        if($request->hasFile('profile_photo')) {
            $imageName = time().'.'.request()->profile_photo->getClientoriginalName();
            request()->profile_photo->move(storage_path('app/public/dogs'), $imageName);
        }
        else {
            $imageName = "";
        }

        $dogs = new Dogs;
        $dogs->dog_name =  $request->dog_name;
        $dogs->dob =  $request->dob;
        $dogs->reg_no =  $request->reg_no;
        $dogs->reg_with =  $request->reg_with;
        $dogs->breeders =  $request->breeder;
        $dogs->is_champion =  $request->is_champion;
        $dogs->profile_photo =  $imageName;
        $dogs->dog_owner =  $request->dog_owner;
        $dogs->microchip =  $request->microchip;
        $dogs->gender =  $request->gender;
        // $dog->class = $request->class;
        $dogs->show_title =  $request->show_title;
        $dogs->achievements =  $request->achievements;
        $dogs->breed_id = $request->breed_id;
        $dogs->ref_id = (string) Str::uuid();
        $dogs->save();

        // $new_dog_id = $dogs->id;
        
        $Dogowner = new DogOwner;
        $Dogowner->owner_id = $request->dog_owner;
        $Dogowner->dog_id = $dogs->id;
        $Dogowner->type = 'Owner';
        
        $new_ref_id = $dogs->ref_id;


        $parent = new DogsRealParent;
        $parent->dog_id = $new_ref_id;
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
        Event_Result::where('id',$id)->update(array('status' => 'Inactive'));
        return redirect()->route('event_results.index')->with('message', 'Record Permenantly Deleted!');
    }

}

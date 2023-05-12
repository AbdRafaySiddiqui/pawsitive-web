<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Clubs;
use App\Models\Cities;
use App\Models\Breeds;
use App\Models\Events;
use App\Models\Judges;
use App\Models\Countries;
use App\Models\EventJudges;
use App\Models\Event_Result;
use Illuminate\Pagination\Paginator;
use League\Csv\Writer;

class EventsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        Paginator::useBootstrap();
        $event = Events::where('status', 'Active')->orderBy('id','DESC')->paginate('10');
       
        return view('events.index', compact('event'));
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
        $judges = Judges::get();
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
	    $events->start_date = $request->start_date;
	    $events->end_date = $request->end_date;
        $events->save();

        $event_judges = new EventJudges;
        $event_judges->event_id = $events->id; // use the last inserted event ID

        if(is_array($request->judge_id) && count($request->judge_id) > 1) {
            foreach($request->judge_id as $judgeId) {
                $event_judges = new EventJudges;
                $event_judges->event_id = $events->id;
                $event_judges->judge_id = $judgeId;
                $event_judges->save();
            }
        } else {
            $event_judges->judge_id = $request->judge_id[0];
            $event_judges->save();
        }

        
        return redirect()->route('events.index')->with('message', 'Record added successfully');
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
        // $event_judges = EventJudges::find($id);
        $event_judges = EventJudges::select('event_judges.event_id','event_judges.judge_id as judge_id','judges.full_name as full_name','judges.id as judgeid')
                        ->leftjoin('judges','judges.id','=','event_judges.judge_id')
                        ->where('event_judges.event_id','=',$id)
                        ->get();

        $total_clubs = Clubs::get();
        $total_countries = Countries::get();
        $total_cities = Cities::get();
        $judges = Judges::get();
        return view('events.edit', compact('events','total_countries','total_cities','total_clubs','judges','event_judges'));
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
            'start_date'=>'required',
            'end_date'=>'required',
            'judge_id'=>'required',
        ]); 
        $events = Events::find($id);

        // Getting values from the blade template form
        $events->name =  $request->event_name;
	    $events->club_id = $request->club_id;
	    $events->city = $request->city;
	    $events->country = $request->country;
	    $events->start_date = $request->start_date;
	    $events->end_date = $request->end_date;
	    $events->judge_id = $request->judge_id;
        $events->update();
 
        return redirect()->route('events.index')->with('message', 'Record updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        Events::where('id',$id)->update(array('status' => 'Inactive'));
        return redirect()->route('events.index')->with('message', 'Record Permenantly Deleted!');
    }


// modal data submit 
public function submitForm(Request $request)
{

    $request->validate([
        'full_name'=>'required',
        'position_in_club'=>'required',
        'description'=>'required',
   
    ]); 

    if(!empty(request()->img)){
        $imageName = time().'.'.request()->img->getClientOriginalExtension();
            request()->img->move(storage_path('app/public/judge_imgs'), $imageName);
    }

    if(!empty(request()->sig)){
            $imagesig = time().'.'.request()->sig->getClientOriginalExtension();
            request()->sig->move(storage_path('app/public/judge_sigs'), $imagesig);
    }

    if(!empty($imageName) && !empty($imagesig)){

    $create =  new Judges;
    $create->full_name = $request->full_name;
    $create->position_in_club = $request->position_in_club;
    $create->facebook = $request->facebook;
    $create->instagram = $request->instagram;
    $create->linkedIn = $request->linkedIn;
    $create->twitter = $request->twitter;
    $create->description = htmlentities($request->description);
    $create->image = $imageName;
    $create->signature = $imagesig;
    $link = str_replace(" ", "-", $request->full_name);
    $create->url_link = $link; 
    $create->save();

        }elseif(!empty($imageName) && empty($imagesig)){

            $create =  new Judges;
    $create->full_name = $request->full_name;
    $create->position_in_club = $request->position_in_club;
    $create->facebook = $request->facebook;
    $create->instagram = $request->instagram;
    $create->linkedIn = $request->linkedIn;
    $create->twitter = $request->twitter;
    $create->description = htmlentities($request->description);
    $create->image = $imageName;
    $link = str_replace(" ", "-", $request->full_name);
    $create->url_link = $link; 
    $create->save();

        }elseif(empty($imageName) && !empty($imagesig)){

            $create =  new Judges;
            $create->full_name = $request->full_name;
            $create->position_in_club = $request->position_in_club;
            $create->facebook = $request->facebook;
            $create->instagram = $request->instagram;
            $create->linkedIn = $request->linkedIn;
            $create->twitter = $request->twitter;
            $create->description = htmlentities($request->description);
            $create->signature = $imagesig;
            $link = str_replace(" ", "-", $request->full_name);
            $create->url_link = $link; 
            $create->save();

        }elseif(!empty($imageName)){

            $create =  new Judges;
    $create->full_name = $request->full_name;
    $create->position_in_club = $request->position_in_club;
    $create->facebook = $request->facebook;
    $create->instagram = $request->instagram;
    $create->linkedIn = $request->linkedIn;
    $create->twitter = $request->twitter;
    $create->description = htmlentities($request->description);
    $create->image = $imageName;
    $link = str_replace(" ", "-", $request->full_name);
    $create->url_link = $link; 
    $create->save();

        }elseif(!empty($imagesig)){

            $create =  new Judges;
    $create->full_name = $request->full_name;
    $create->position_in_club = $request->position_in_club;
    $create->facebook = $request->facebook;
    $create->instagram = $request->instagram;
    $create->linkedIn = $request->linkedIn;
    $create->twitter = $request->twitter;
    $create->description = htmlentities($request->description);
    $create->signature = $imagesig;
    $link = str_replace(" ", "-", $request->full_name);
    $create->url_link = $link; 
    $create->save();

        }else{

            $create =  new Judges;
    $create->full_name = $request->full_name;
    $create->position_in_club = $request->position_in_club;
    $create->facebook = $request->facebook;
    $create->instagram = $request->instagram;
    $create->linkedIn = $request->linkedIn;
    $create->twitter = $request->twitter;
    $create->description = htmlentities($request->description);
    $link = str_replace(" ", "-", $request->full_name);
    $create->url_link = $link; 
    $create->save();

        }

    return response()->json([
        'success' => true,
        'message' => 'Form submitted successfully',
        'response' =>   $create
    ]);



}

public function details($eventId)
{
    $event = Events::find($eventId);
    $class = Event_Result::select('class')->where('event_id', $eventId)->distinct()->get()->pluck('class')->toArray();
    $event['class'] = $class;
    return response()->json($event);
}

public function download()
{
    // Fetch data from the database
    $events = Events::all();

    // Create a new CSV file and write the data to it
    $csv = Writer::createFromString('');
    $csv->insertOne(['name', 'date', 'club_id', 'judge_id', 'country', 'city', 'status']);

    foreach ($events as $event) {
        $csv->insertOne([
            $event->name,
            $event->date,
            $event->club_id,
            $event->judge_id,
            $event->country,
            $event->city,
            $event->status,
        ]);
    }

    // Download the CSV file
    $headers = [
        'Content-Type' => 'text/csv',
        'Content-Disposition' => 'attachment; filename="events.csv"',
    ];

    return response($csv->getContent(), 200, $headers);
}

}

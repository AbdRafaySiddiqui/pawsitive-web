<?php

namespace App\Http\Controllers\API;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Events;
use App\Models\Dogs;

class EventController extends Controller
{
    public function retrieve($breed_id)
    {
        $results = DB::table('event_results')
                ->join('dogs', 'event_results.dog_id', '=', 'dogs.id')
                ->join('breeds', 'dogs.breed_id', '=', 'breeds.id')
                ->join('events', 'event_results.event_id', '=', 'events.id')
                ->join('clubs', 'events.club_id', '=', 'clubs.id')
                ->join('countries', 'events.country', '=', 'countries.idCountry')
                ->leftJoin('event_judges', 'events.id', '=', 'event_judges.event_id')
                ->leftJoin('judges', 'event_judges.judge_id', '=', 'judges.id')
                ->select('events.start_date',
                         'events.end_date',
                         'events.name AS event',
                         'clubs.name AS club',
                         'countries.countryName AS country',
                         'countries.countryCode',
                         'judges.full_name AS judge',
                         'events.id AS eventId')
                ->where('event_results.breed_id', '=', $breed_id)
                ->where('events.status', '=', 'Active')
                ->orderBy('events.start_date', 'desc')
                ->distinct('events.id')
                ->get();
        return response()->json(['event_detailz' => $results]);
    }
    
   
    public function filterEvents(Request $request)
    {
        $query = DB::table('event_results')
                ->join('dogs', 'event_results.dog_id', '=', 'dogs.id')
                ->join('breeds', 'dogs.breed_id', '=', 'breeds.id')
                ->join('events', 'event_results.event_id', '=', 'events.id')
                ->join('clubs', 'events.club_id', '=', 'clubs.id')
                ->join('countries', 'events.country', '=', 'countries.idCountry')
                ->join('judges', 'events.judge_id', '=', 'judges.id')
                ->select('events.start_date',
                         'events.end_date',
                        'events.name AS event',
                        'clubs.name AS club',
                        'countries.countryName AS country',
                        'countries.countryCode',
                        'judges.full_name AS judge',
                        'events.id AS eventId')
                ->distinct('events.id');
        // Apply filters based on request parameters
        if ($request->has('start_date')) {
            $start_date = $request->input('start_date');
            $query->where('events.start_date', '>=', $start_date);
        }
        if ($request->has('end_date')) {
            $end_date = $request->input('end_date');
            $query->where('events.end_date', '<=', $end_date);
        }
        if ($request->has('country_id')) {
            $country_id = $request->input('country_id');
            $query->where('events.country', '=', $country_id);
        }
         if ($request->has('club_id')) {
            $club_id = $request->input('club_id');
            $query->where('events.club_id', '=', $club_id);
        }
        if ($request->has('breed_id')) {
            $breed_id = $request->input('breed_id');
            $query->where('dogs.breed_id', '=', $breed_id);
        }
        $results = $query->orderBy('events.start_date', 'desc')->get();
        if($results){
                // Convert start_date to Unix timestamp
            foreach ($results as $result) {
                $result->start_date = date('Y-m-d', strtotime($result->start_date));
            }
            return response()->json(['event_result' => $results]);
        }
        else{
            return response()->json('event_result not found.');
        }
    }

    public function champions($breed_id)
    {
        $champions = Dogs::select('dog_name')
                          ->where('breed_id', $breed_id)
                          ->where('is_champion','Yes')
                          ->where('status','=','Active')
                          ->get();

        return response()->json(['champions' => $champions], 200);
    }

}
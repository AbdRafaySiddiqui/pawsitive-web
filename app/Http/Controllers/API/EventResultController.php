<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Breeds;
use App\Models\Clubs;
use App\Models\Events;
use App\Models\Event_Result;
use App\Models\Countries;
use Illuminate\Support\Facades\DB;

class EventResultController extends Controller
{
    public function result()
    {
        $results = DB::table('event_results')
                ->join('dogs', 'event_results.dog_id', '=', 'dogs.id')
                ->join('events', 'event_results.event_id', '=', 'events.id')
                ->join('breeds', 'dogs.breed_id', '=', 'breeds.id')
                ->join('clubs', 'events.club_id', '=', 'clubs.id')
                ->join('countries', 'clubs.country', '=', 'countries.idCountry')
                ->select('events.date',
                         'events.name AS event',
                         'breeds.name AS breedName',
                         'clubs.name AS club',
                         'countries.countryName AS country',
                         'countries.countryCode',
                         'events.id AS eventId')
                ->orderBy('events.date', 'asc')
                ->take(10)
                ->get();
                return response()->json(['event_result' => $results]);
    }
}

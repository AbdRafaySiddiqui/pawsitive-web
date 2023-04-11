<?php

namespace App\Http\Controllers\API;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Events;

class EventController extends Controller
{
    public function retrieve()
    {
        $results = DB::table('events')
                ->join('clubs', 'events.club_id', '=', 'clubs.id')
                ->join('countries', 'events.country', '=', 'countries.idCountry')
                ->join('judges', 'events.judge_id', '=', 'judges.id')
                ->select('events.date', 'events.name AS event', 'clubs.name AS club', 'countries.countryName AS country', 'countries.countryCode', 'judges.full_name AS judge', 'events.id AS eventId')
                ->orderBy('events.date', 'asc')
                ->get();
                return response()->json(['event_detailz' => $results]);
    }

    public function filterEvents(Request $request)
    {
        $query = DB::table('events')
                    ->join('clubs', 'events.club_id', '=', 'clubs.id')
                    ->join('countries', 'events.country', '=', 'countries.idCountry')
                    ->join('judges', 'events.judge_id', '=', 'judges.id')
                    ->select('events.date', 'events.name AS event', 'clubs.name AS club', 'countries.countryName AS country', 'countries.countryCode', 'judges.full_name AS judge', 'events.id AS eventId');

        // Apply filters based on request parameters
        if ($request->has('start_date')) {
            $start_date = $request->input('start_date');
            $query->where('events.date', '>=', $start_date);
        }
        if ($request->has('end_date')) {
            $end_date = $request->input('end_date');
            $query->where('events.date', '<=', $end_date);
        }
        if ($request->has('country_id')) {
            $country_id = $request->input('country_id');
            $query->where('events.country', '=', $country_id);
        }
        if ($request->has('club_id')) {
            $club_id = $request->input('club_id');
            $query->where('events.club_id', '=', $club_id);
        }

        $results = $query->orderBy('events.date', 'asc')->get();

        return response()->json(['event_result' => $results]);
    }

}

<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Clubs;

class ClubController extends Controller
{
    //
    public function listing(request $request)
    {
        $club = Clubs::select('clubs.id',
        'clubs.name as clubs_name',
        'email',
        'phone',
        'countries.countryName as country_of_origin',
        'cities.city as city_of_origin',
        'affiliation')
        //   ->leftjoin('species','species.id','=','breeds.sp_id')
        ->leftjoin('countries','countries.idCountry','=','clubs.country')
        ->leftjoin('cities','cities.id','=','clubs.city')
          ->where('clubs.status','=','Active')
          ->orderBy('clubs.name','ASC')
          ->get();
        
        return response()->json(['club' => $club], 200);
    }

    public function details(request $request,$id)
    {
        $club = Clubs::select('clubs.id',
        'clubs.name as clubs_name',
        'email',
        'phone',
        'countries.countryName as country_of_origin',
        'cities.city as city_of_origin',
        'affiliation')
        //   ->leftjoin('species','species.id','=','breeds.sp_id')
        ->leftjoin('countries','countries.idCountry','=','clubs.country')
        ->leftjoin('cities','cities.id','=','clubs.city')
        ->where('clubs.id','=',$id)
          ->orderBy('clubs.name','ASC')
          ->first();
        
        return response()->json(['club' => $club], 200);
    }
}

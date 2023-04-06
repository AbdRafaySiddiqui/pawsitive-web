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
        'affiliation','image')
        //   ->leftjoin('species','species.id','=','breeds.sp_id')
        ->leftjoin('countries','countries.idCountry','=','clubs.country')
        ->leftjoin('cities','cities.id','=','clubs.city')
          ->where('clubs.status','=','Active')
          ->orderBy('clubs.name','ASC')
          ->get();
     
        foreach($club as $clubs)
        {
          if($clubs->clubs_name != null){
            $name=$clubs->clubs_name;
            $clubs->clubs_name=   ucfirst( $name);
          }
          
            // $pp = Clubs::where('id','=',$clubs->id)->inRandomOrder()->get();

                    if($clubs->image != null)
                    {
                        $clubs->image = asset('storage/app/public/club_images').'/'.$clubs->image;
                    }
                    else
                    {
                      $clubs->image = asset('storage/app/public/img/noimage.png');
                    }
        }
        
        
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
        'affiliation','image')
        //   ->leftjoin('species','species.id','=','breeds.sp_id')
        ->leftjoin('countries','countries.idCountry','=','clubs.country')
        ->leftjoin('cities','cities.id','=','clubs.city')
        ->where('clubs.id','=',$id)
          ->orderBy('clubs.name','ASC')
          ->first();
        
            if($club->clubs_name != null){
              $name=$club->clubs_name;
              $club->clubs_name=   ucfirst( $name);
            }

            
            if($clubs->image != null)
            {
                $club->image = asset('storage/app/public/club_images').'/'.$club->image;
            }
            else
            {
              $club->image = asset('storage/app/public/img/noimage.png');
            }
          
        return response()->json(['club' => $club], 200);
    }
}

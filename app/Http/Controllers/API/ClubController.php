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
                              'clubs.website as clubs_website',
                              'clubs.phone as clubs_phone',
                              'clubs.address as clubs_address',
                              'clubs.email as clubs_email',
                              'clubs.affiliation as clubs_affiliation',
                              'countries.countryName as country_of_origin',
                              'image as logo')
        ->leftjoin('countries','countries.idCountry','=','clubs.country')
        ->leftjoin('cities','cities.id','=','clubs.city')
        ->where('clubs.status','=','Active')
        ->orderBy('clubs.name','ASC')
        ->get();
     
        foreach($club as $clubs)
        {

          if($clubs->logo != null)
          {
            if(file_exists(storage_path('/app/public/club_images/'.$clubs->logo)))
            {
              $clubs->logo = asset('storage/app/public/club_images').'/'.$clubs->logo;
            }
            else
            {
              $clubs->logo = asset('storage/app/public/noimage.png');
            }
          }
          else
          {
            $clubs->logo = asset('storage/app/public/noimage.png');
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
        'affiliation as affiliatedBy',
        'image as logo')
        // 'address',
        // 'website')
        ->leftjoin('countries','countries.idCountry','=','clubs.country')
        ->leftjoin('cities','cities.id','=','clubs.city')
        ->where('clubs.id','=',$id)
          ->orderBy('clubs.name','ASC')
          ->first();
            
            if($club->logo != null)
            {
              if(file_exists(storage_path('app/public/club_images/'.$club->logo)))
              {
                $club->logo = asset('storage/app/public/club_images').'/'.$club->logo;
              }
              else
              {
                $club->logo = asset('storage/app/public/noimage.png');
              }
            }
            else
            {
              $club->logo = asset('storage/app/public/noimage.png');
            }
          
        return response()->json(['club' => $club], 200);
    }

    public function retrieve()
    {
      $clubs = Clubs::all();
      $clubsdata = $clubs->map(function($club){
        return [
          'id' => $club->id,
          'label' => $club->name,
        ];
      });
      return response()->json(['club' => $clubsdata]);
    }
    

}

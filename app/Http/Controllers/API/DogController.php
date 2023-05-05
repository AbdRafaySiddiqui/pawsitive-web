<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Breeds;
use App\Models\Dogs;
use DB;

class DogController extends Controller
{
    public function listing(request $request, $id)
    {
      $dog = DB::table('dogs')->select(DB::raw('dogs.id,dogs.dog_name as dogs_name,dogs.profile_photo as profilePhoto'))
      ->leftjoin('breeds','breeds.id','=','dogs.breed_id')
        ->where('breed_id','=',$id)
        ->where('dogs.status','=','Active')
        ->orderBy('dogs.dog_name','ASC')
        ->get();
       
          foreach($dog as $dogs)
                      {
              
                      if($dogs->profilePhoto != null)
                      {
                        // Check if profile photo starts with "https://"
                      if (strpos($dogs->profilePhoto, 'https://') === 0)
                        {
                        $dogs->profilePhoto = $dogs->profilePhoto;
                        }
                        // Check if profile photo exists in local storage
                      elseif (file_exists(storage_path('/app/public/dog_profile'.'/'.$dogs->profilePhoto)))
                      {
                        $dogs->profilePhoto = asset('storage/app/public/dog_profile').'/'.$dogs->profilePhoto;
                      }
                      }
                      else
                      {
                        $dogs->profilePhoto = asset('storage/app/public/noimage.png');
                      }
                      }

        return response()->json(['dog' => $dog], 200);
    }

    public function details(request $request, $id)
    {
        $dog = Dogs::select('dogs.id',
        'dogs.dog_name as dogs_name',
        'dob',
        'gender',
        'breeds.name as breed_name',
        'microchip',
        'reg_no',
        'achievements',
        'show_title')
        ->leftjoin('breeds','breeds.id','=','dogs.breed_id')
        
          ->where('dogs.id','=',$id)
          ->orderBy('dogs.id','ASC')
          ->first();
        
        return response()->json(['dog' => $dog], 200);
    }

    public function alldogs(request $request)
    {
      if($request->has('q')){
        $search = $request->q;
        $data =  DB::table('dogs')
  ->select(DB::raw('id,dog_name, status'))
          ->where('dog_name','LIKE',"%$search%")
          ->orderBy('dog_name','ASC')
          ->get();
        }
        else{
          $data=  DB::table('dogs')
  ->select(DB::raw('id,dog_name, status'))
  ->paginate(10);
      }
        return response()->json($data);
    }

    public function breed_dog(request $request)
    {
      if($request->has('breed_id')){
        $search = $request->q;
        $id = $request->breed_id;
        $dog = DB::table('dogs')
  ->select(DB::raw('dogs.id as dog_id,
  dogs.dog_name as dog_name,dogs.breed_id,breeds.id'
          ))
          ->leftjoin('breeds','breeds.id','=','dogs.breed_id')
        
          ->where('dogs.breed_id','=',$id)

          ->where('dog_name','LIKE',"%$search%")
          ->orderBy('breed_id','ASC')
          ->get();
        }
        else{
          $dog = Dogs::select('dogs.id',
          'dog_name'
            )
            ->orderBy('dogs.id','ASC')
            
            ->paginate(10);
      }
        return response()->json(['dog' => $dog]);
    }
    public function dog_profile(request $request)
    {
        $dog = Dogs::select('id','dog_name as dogName','profile_photo as profilePhoto')
                    //   ->leftjoin('species','species.id','=','breeds.sp_id')
                      ->where('status','=','Active')
                      ->orderBy('dog_name','ASC')
                      ->get();

                      foreach($dog as $dogs)
                      {
              
                        if($dogs->profilePhoto != null)
                        {
                          if (strpos($dogs->profilePhoto, 'https://') === 0)
                            {
                            $dogs->profilePhoto = $dogs->profilePhoto;
                            }
                          elseif(file_exists(storage_path().'/app/public/dog_profile'.'/'.$dogs->image))
                          {
                            $dogs->profilePhoto = asset('storage/app/public/dog_profile').'/'.$dogs->image;
                          }
                          else
                          {
                            $dogs->profilePhoto = asset('storage/app/public/noimage.png');
                          }
                        }
                        else
                        {
                          $dogs->profilePhoto = asset('storage/app/public/noimage.png');
                        }
                      }
                      return response()->json(['profile' => $dog], 200);
}



public function profile_details(request $request)
  {
    $results = DB::table('dogs')
    ->leftJoin('breeds', 'breeds.id', '=', 'dogs.breed_id')
    ->leftJoin('dog_real_parents', 'dog_real_parents.dog_id', '=', 'dogs.id')
    ->leftJoin('dogs as sire', 'sire.id', '=', 'dog_real_parents.sire_id')
    ->leftJoin('dogs as dam', 'dam.id', '=', 'dog_real_parents.dam_id')
    ->leftJoin('dog_owners', 'dog_owners.dog_id', '=', 'dogs.dog_owner')
    ->leftJoin('users', 'users.id', '=', 'dog_owners.owner_id')
    ->where('dogs.status', '=', 'Active')
    ->select('dogs.id', 
            'dogs.dog_name as dogName', 
            'dogs.show_title as title', 
            'dogs.gender', 
            'dogs.microchip',
            'sire.dog_name as sire_name', 
            'dam.dog_name as dam_name', 
            'dogs.reg_no as registration', 
            'dogs.breeders', 
            DB::raw("GROUP_CONCAT(users.name SEPARATOR ',') as owners"))
    ->groupBy('dogs.id', 
              'dogs.dog_name', 
              'dogs.show_title', 
              'dogs.gender', 
              'dogs.microchip', 
              'sire.dog_name', 
              'dam.dog_name', 
              'dogs.reg_no', 
              'dogs.breeders')
    ->orderBy('dogs.dog_name', 'asc')
    ->get();

    return response()->json(['profile_details' => $results], 200);
  }

}

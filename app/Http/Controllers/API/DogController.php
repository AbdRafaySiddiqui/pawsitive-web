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
        
          ->where('breed_id','=',$id)
          ->orderBy('dogs.dog_name','ASC')
          ->first();
        
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
          ->orderBy('dogs.dog_name','ASC')
          ->first();
        
        return response()->json(['dog' => $dog], 200);
    }

    public function alldogs(request $request)
    {
      if($request->has('q')){
        $search = $request->q;
        $data = Dogs::select('dogs.id',
        'dog_name',
          )
          ->where('dog_name','LIKE',"%$search%")
          ->orderBy('dog_name','ASC')
          ->get();
        }
        else{
          $data = Dogs::select('dogs.id',
          'dog_name'
            )
            ->orderBy('dog_name','ASC')
                  ->get();
      }
        return response()->json($data);
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
                          if(file_exists(storage_path().'/app/public/dog_profile'.'/'.$dogs->image))
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
    $profile_details = Dogs::select('dogs.id',
    'dogs.dog_name as dogName',
    'dogs.show_title as title',
    'dogs.gender',
    'dogs.microchip',
    'sire.dog_name as sire_name',
    'dam.dog_name as dam_name',
    'dogs.reg_no as registration',
    'dogs.breeders',
    DB::raw('GROUP_CONCAT(users.name SEPARATOR \',\') as owners'))

 ->leftjoin('breeds','breeds.id','=','dogs.breed_id')
 ->leftjoin('dog_real_parents','dog_real_parents.dog_id','=','dogs.id')
 ->leftjoin('dogs as sire','sire.id','=','dog_real_parents.sire_id')
 ->leftjoin('dogs as dam','dam.id','=','dog_real_parents.dam_id')
 ->leftjoin('dog_owners','dog_owners.dog_id','=','dogs.dog_owner')
 ->leftjoin('users','users.id','=','dog_owners.owner_id')
 ->where('dogs.status','=','Active')
 ->orderBy('dogs.dog_name','ASC')
 ->get();

                
                  return response()->json(['profile_details' => $profile_details], 200);
}

}

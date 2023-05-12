<?php

namespace App\Http\Controllers\API;
use Illuminate\Support\Collection;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Breeds;
use App\Models\Dogs;
use DB;

class DogController extends Controller
{


  function add(Request $req)
  {
      $dog = Dogs::where('ref_id', $req->ref_id)->first();
      if ($dog) {
          // Update the existing record
          $dog->profile_photo = $req->profile_photo;
          $result = $dog->save();
          if ($result) {
              return ["Result" => "Updated successfully."];
          } else {
              return ["Result" => "Some error occurred while updating."];
          }
      } else {
              return ["Result" => "Some error occurred while inserting."];
          }
  }  

  public function listingNew(Request $request, $id)
{
    $dogs = DB::table('dogs')
        ->select(
            'dogs.id',
            'dogs.dog_name as dogs_name',
            'dogs.profile_photo as profilePhoto'
        )
        ->leftJoin('breeds', 'breeds.id', '=', 'dogs.breed_id')
        ->where('breed_id', '=', $id)
        ->where('dogs.status', '=', 'Active')
        ->orderBy('dogs.dog_name', 'ASC')
        ->paginate(1000); // Set the number of records per page
    
    $dogCollection = collect($dogs->items())->map(function ($dog) {
        if ($dog->profilePhoto != null) {
            // Check if profile photo starts with "https://"
            if (strpos($dog->profilePhoto, 'https://') === 0) {
                $dog->profilePhoto = $dog->profilePhoto;
            }
            // Check if profile photo exists in local storage
            elseif (file_exists(storage_path('/app/public/dog_profile'.'/'.$dog->profilePhoto))) {
                $dog->profilePhoto = asset('storage/app/public/dog_profile').'/'.$dog->profilePhoto;
            }
        } else {
            $dog->profilePhoto = asset('storage/app/public/noimage.png');
        }
        return $dog;
    });
    
    // Do something with the dog collection, such as return it to the client
    
    return response()->json([
    'data' => $dogCollection,
    'current_page' => $dogs->currentPage(),
    'last_page' => $dogs->lastPage(),
    'per_page' => $dogs->perPage(),
    'total' => $dogs->total(),
]);
}

    public function listing(Request $request, $id)
    {
        $dogs = DB::table('dogs')
            ->select(
                'dogs.id',
                'dogs.dog_name as dogs_name',
                'dogs.profile_photo as profilePhoto'
            )
            ->leftJoin('breeds', 'breeds.id', '=', 'dogs.breed_id')
            ->where('breed_id', '=', $id)
            ->where('dogs.status', '=', 'Active')
            ->orderBy('dogs.dog_name', 'ASC')
            ->get();
    
        $dogCollection = collect($dogs)->map(function ($dog) {
            if ($dog->profilePhoto != null) {
                // Check if profile photo starts with "https://"
                if (strpos($dog->profilePhoto, 'https://') === 0) {
                    $dog->profilePhoto = $dog->profilePhoto;
                }
                // Check if profile photo exists in local storage
                elseif (file_exists(storage_path('/app/public/dog_profile'.'/'.$dog->profilePhoto))) {
                    $dog->profilePhoto = asset('storage/app/public/dog_profile').'/'.$dog->profilePhoto;
                }
            } else {
                $dog->profilePhoto = asset('storage/app/public/noimage.png');
            }
            return $dog;
        });
    
        return response()->json(['dog' => $dogCollection], 200);
    }

    // return response()->json(['dog' => $dogCollection], 200);

    public function details(request $request, $id)
    {
        $dog = Dogs::select('dogs.id',
        'dogs.dog_name as dogs_name',
        'dogs.profile_photo', 
        'dogs.dob',
        'dogs.gender',
        'breeds.name as breed_name', 
        'dogs.microchip',
        'dogs.reg_no',
        'dogs.achievements',
        'sire.dog_name as sire_name', 
        'dam.dog_name as dam_name',
        'dogs.show_title',
        'dogs.dog_owner',
        'dogs.reg_with',
        'dogs.breeders')
        ->leftjoin('breeds','breeds.id','=','dogs.breed_id')
        ->leftJoin('dog_real_parents', 'dog_real_parents.dog_id', '=', 'dogs.id')
        ->leftJoin('dogs as sire', 'sire.ref_id', '=', 'dog_real_parents.sire_id')
        ->leftJoin('dogs as dam', 'dam.ref_id', '=', 'dog_real_parents.dam_id')
        ->leftJoin('dog_owners', 'dog_owners.dog_id', '=', 'dogs.id')
        ->leftJoin('users', 'users.id', '=', 'dog_owners.owner_id')
          ->where('dogs.id','=',$id)
        ->where('dogs.status', '=', 'Active')
        ->orderBy('dogs.id','ASC')
        ->get();
        
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

    public function breed_dog(Request $request)
{
    if($request->has('breed_id')){
        $search = $request->q;
        $id = $request->breed_id;
        $dog = DB::table('dogs')
            ->select(DB::raw('dogs.id as id, dogs.dog_name as dog_name, dogs.breed_id'))
            ->where('dogs.breed_id', '=', $id)
           ->where('dog_name', 'LIKE', "%$search%")
            ->orderBy('breed_id', 'ASC')
            ->paginate(10);
            // ->get();
    } else {
        $data = Dogs::select('dogs.id', 'dog_name')
            ->orderBy('dog_name', 'ASC')
            ->get();
    }
    return response()->json(['dog' => $dog], 200);
}
public function male(Request $request)
{
  if($request->has('breed_id')){
    $search = $request->q;
    $id = $request->breed_id;
        $dog = DB::table('dogs')
            ->select(DB::raw('dogs.id as id, dogs.dog_name as dog_name, dogs.breed_id'))
            ->where('dogs.breed_id', '=', $id)
            ->where('dog_name', 'LIKE', "%$search%")
           ->where('dogs.gender', '=', 'Male')
            ->orderBy('dogs.id', 'ASC')
            ->paginate(10);
            // ->get();
  }
    return response()->json(['dog' => $dog], 200);
}
public function female(Request $request)
{
  if($request->has('breed_id')){
    $search = $request->q;
    $id = $request->breed_id;
        $dog = DB::table('dogs')
            ->select(DB::raw('dogs.id as id, dogs.dog_name as dog_name, dogs.breed_id'))
            ->where('dogs.breed_id', '=', $id)
            ->where('dog_name', 'LIKE', "%$search%")
           ->where('dogs.gender', '=', 'Female')
            ->orderBy('dogs.id', 'ASC')
            ->paginate(10);
            // ->get();
  }
    return response()->json(['dog' => $dog], 200);
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
<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Breeds;
use App\Models\Dogs;


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
        $dog = Dogs::select('id','dog_name','profile_photo')
                    //   ->leftjoin('species','species.id','=','breeds.sp_id')
                      ->where('status','=','Active')
                      ->orderBy('dog_name','ASC')
                      ->get();

                      foreach($dog as $dogs)
                      {
              
                        if($dogs->profile_photo != null)
                        {
                          if(file_exists(storage_path().'/app/public/dog_profile'.'/'.$dogs->image))
                          {
                            $dogs->profile_photo = asset('storage/app/public/dog_profile').'/'.$dogs->image;
                          }
                          else
                          {
                            $dogs->profile_photo = asset('storage/app/public/noimage.png');
                          }
                        }
                        else
                        {
                          $dogs->profile_photo = asset('storage/app/public/noimage.png');
                        }
                      }
                      return response()->json(['profile' => $dog], 200);
}

}

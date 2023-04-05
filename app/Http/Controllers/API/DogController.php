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
        //   ->leftjoin('species','species.id','=','breeds.sp_id')
        ->leftjoin('breeds','breeds.id','=','dogs.breed_id')
        
          ->where('breed_id','=',$id)
          ->orderBy('dogs.dog_name','ASC')
          ->get();
        
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
        //   ->leftjoin('species','species.id','=','breeds.sp_id')
        ->leftjoin('breeds','breeds.id','=','dogs.breed_id')
        
          ->where('dogs.id','=',$id)
          ->orderBy('dogs.dog_name','ASC')
          ->first();
        
        return response()->json(['dog' => $dog], 200);
    }
}
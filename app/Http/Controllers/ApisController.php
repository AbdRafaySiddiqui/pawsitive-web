<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\judges;
class ApisController extends Controller
{
    //

    public function dataAjax(Request $request)
    {
    
        if($request->has('q')){
            $search = $request->q;
            $data =judges::select("id","full_name")
            		->where('full_name','LIKE',"%$search%")
            		->get();
        }
        return response()->json($data);

    }
   
}

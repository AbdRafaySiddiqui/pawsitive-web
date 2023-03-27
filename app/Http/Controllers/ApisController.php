<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Dogs;
class ApisController extends Controller
{
    //

    public function dataAjax(Request $request)
    {
    
        if($request->has('q')){
            $search = $request->q;
            $data =Dogs::select("id","dog_name")
            		->where('dog_name','LIKE',"%$search%")
            		->get();
        }
        return response()->json($data);

    }
}

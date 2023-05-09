<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Cities;
use Illuminate\Support\Facades\DB;

class CitiesController extends Controller
{
 public function getCities($idCountry)
    {
        $cities = Cities::where('country', $idCountry)->select('id', 'city')->get();
        return response()->json($cities);
    }


}

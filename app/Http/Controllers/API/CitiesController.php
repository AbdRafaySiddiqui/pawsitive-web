<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Cities;
use Illuminate\Support\Facades\DB;

class CitiesController extends Controller
{
    public function getCities($countryName)
{
    $cities = Cities::where('country', $countryName)->get(['id', 'city']);
    return response()->json($cities);
}


}

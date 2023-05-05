<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Cities;
use Illuminate\Support\Facades\DB;

class CitiesController extends Controller
{
    public function getCities(Request $request)
    {
        $countryId = $request->input('countryId');

        $cities = Cities::where('country', $countryId)->select('id', 'city')->get();
        return response()->json(['cities' => $cities], 200);
    }


}

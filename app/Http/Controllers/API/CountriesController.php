<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Countries;

class CountriesController extends Controller
{
    public function country_details($idCountry)
{
    $country = Countries::find($idCountry);

    if (!$country) {
        return response()->json(['error' => 'country not found'], 404);
    }

    return $country;
}

}

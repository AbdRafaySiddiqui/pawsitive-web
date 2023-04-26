<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Countries;

class CountriesController extends Controller
{
    public function country_details($countryId)
{
    $country = Countries::find($countryId);

    if (!$country) {
        return response()->json(['error' => 'country not found'], 404);
    }

    return $country;
}

public function getCountries()
{
    $countries = Countries::select('idCountry', 'countryName')->get();
    return response()->json(['countries' => $countries], 200);
}

}

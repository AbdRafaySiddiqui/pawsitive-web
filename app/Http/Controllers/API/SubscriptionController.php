<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Subscriptions;

class SubscriptionController extends Controller
{
    function add(Request $req)
    {
        $array = json_decode($req->getContent());

        $subscription = new Subscriptions;
        $subscription->name = $array->name;
        $subscription->email = $array->email;
        $subscription->breed = $array->breed;

        if($subscription->save())
        {
            return response()->json(["Result" => "Inserted Successfully."], 200);
        }
        else
        {
            return response()->json(["Result" => "Some error occurred."], 500);
        }
    }
}

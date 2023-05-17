<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Subscriptions;

class SubscriptionController extends Controller
{
    function add(Request $req)
    {
        $subscription = new Subscriptions;
        $subscription->name=$req->name;
        $subscription->email=$req->email;
        $subscription->breed=$req->breed;
        $result=$subscription->save();
        if($result)
        {
            return response()->json(["Result" => "Inserted Successfully."], 200);
        }
        else
        {
            return response()->json(["Result" => "Some error occurred."], 500);
        }
    }
}

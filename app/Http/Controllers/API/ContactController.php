<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Contact;

class ContactController extends Controller
{
    function add(Request $req)
    {
        $contact = new contact;
        $contact->name=$req->name;
        $contact->email=$req->email;
        $contact->message=$req->message;
        $result=$contact->save();
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

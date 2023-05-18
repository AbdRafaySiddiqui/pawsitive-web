<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Contact;
use Mail;
use App\Mail\DemoMail;

class ContactController extends Controller
{
    function add(Request $req)
    {
        $contact = new contact;
        $contact->name=$req->name;
        $contact->email=$req->email;
        $contact->message=$req->message;
        $result=$contact->save();

        $mailData = [

            'title' => $req->name,
            'body' => 'Thank you for contacting us. We appreciate your interest and will respond to your inquiry as soon as possible. If you have any further questions or require immediate assistance, please feel free to reach out to us. Thank you again for reaching out to us.'
        ];

        $ck = Mail::to($req->email)->send(new DemoMail($mailData));

        if($result && $ck)
        {
            return response()->json(["Result" => "Inserted Successfully."], 200);
        }
        else
        {
            return response()->json(["Result" => "Some error occurred."], 500);
        }

    }
}

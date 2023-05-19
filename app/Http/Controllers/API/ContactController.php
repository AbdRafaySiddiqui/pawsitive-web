<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Contact;
use App\Models\ContactClub;
use Mail;
use App\Mail\DemoMail;
use App\Mail\ClubMail;
use App\Mail\RecieveDemoMail;
use App\Mail\RecieveClubMail;

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
        ];

        $ck = Mail::to($req->email)->send(new DemoMail($mailData));

        $recieveData = [
            'title' => $req->name,
            'email' => $req->email,
            'body' => $req->message
        ];

        $rd = Mail::to('pawsitive@pawsitive.com')->send(new RecieveDemoMail($recieveData));

        if($result && $ck && $rd)
        {
            return response()->json(["Result" => "Inserted Successfully."], 200);
        }
        else
        {
            return response()->json(["Result" => "Some error occurred."], 500);
        }

    }

    function contact(Request $req)
    {
        $array = json_decode($req->getContent());

        $contactclub = new ContactClub;

        $contactclub->name = $array->name;
        $contactclub->email = $array->email;
        $contactclub->message = $array->message;
        $contactclub->club_id = $array->club_id;
        $contactclub->club_name = $array->club_name;
        $result = $contactclub->save();

        $mailData = [

            'title' => $req->name,
            'club' => $req->club_name,
            'body' => 'Thank you for contacting us. We appreciate your interest and will convey your message to '. $req->club_name .'. If you have any further questions or require immediate assistance, please feel free to reach out to us. Thank you again for reaching out to us.'
        ];

        $ck = Mail::to($req->email)->send(new ClubMail($mailData));

        $recieveData = [
            'title' => $req->name,
            'email' => $req->email,
            'body' => $req->message,
            'club' => $req->club_name
        ];

        $rd = Mail::to('pawsitive@pawsitive.com')->send(new RecieveClubMail($recieveData));

        if($result && $ck && $rd)
        {
            return response()->json(["Result" => "Inserted Successfully."], 200);
        }
        else
        {
            return response()->json(["Result" => "Some error occurred."], 500);
        }

    }
}
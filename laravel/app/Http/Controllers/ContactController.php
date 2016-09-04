<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Contact;
use App\Http\Requests;

class ContactController extends Controller
{
    public function postAddContact(Request $request)
    {
        $contact = new Contact();
        $contact->first_name = $request['first_name'];
        $contact->last_name = $request['last_name'];
        $contact->phone_number = $request['phone_number'];
        $contact->email = $request['email'];
        $contact->question = $request['question'];

        if($contact->save())
            return response()->json(['status' => 0,
                'message' => 'Question successfully sent.'], 200);
        else
            return response()->json(['status' => 1,
                'message' => 'Question not sent.'], 200);
    }
}
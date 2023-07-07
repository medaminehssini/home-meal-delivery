<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Contact;
class ContactController extends Controller
{
    function setContact(Request $request) {
        $validator = validator($request->only('fname', 'lname',  'email', 'tel', 'subject', 'message' ), [
            'fname' => 'required|string|max:50',
            'lname' => 'required|string|max:255',
            'email' => 'required|Email',
            'tel' => 'required|max:12',
            'subject'=>'required|max:100',
            'message' => 'required|string|min:10|max:255',
        ]);
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 401);
        }
        $contact = new Contact();
        $contact->nom = $request->fname;
        $contact->prenom = $request->lname;
        $contact->email = $request->email;
        $contact->telephone = $request->tel;
        $contact->sujet = $request->subject;
        $contact->message = $request->message;
        $contact->save();
        
        return response()->json(['success' => ['cree_avec_success']], 200);

    }
}

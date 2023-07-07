<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Validator;
use Hash;
class ProfileController extends Controller
{
    public function getprofile() {
          
        return view('profile');
    }
    public function setprofile (Request $request) {
      
        $validator =  Validator::make($request->all(), [
            'fname'   => 'required|min:2|max:50',
            'lname'   => 'required|min:2|max:50',
            'tele'    => 'required|min:2|max:50',
            'adresse' => 'required|max:150',
            'zipcode' => 'required|min:1|max:20',
            'ville'   => 'required|max:50',
        ])->validate();



        if ($request->ancien_mot_de_passe != null )
        {
            $validator =  Validator::make($request->all(), [
                'ancien_mot_de_passe'   => 'required|min:2|max:50',
                'mot_de_passe'   => 'required|confirmed',
            ])->validate();
            if (Hash::check( $request->ancien_mot_de_passe,Auth::user()->password))
            {
                Auth::user()->password = Hash::make($request->mot_de_passe);
            }else {
                return back()->with('error', 'verifier votre ancien mot de passe'  );

            }
        }
        if ( $request->image != null ) {
            $validator =  Validator::make($request->all(), [
                'image'=>'required|image|mimes:jpg,jpeg,png,gif|max:4000',
            ])->validate();
            
            $img_name = time().'.'.$request->image->getClientOriginalExtension();
            $request->image->move(public_path('uploads/img/profile'),$img_name);
            Auth::user()->image = 'uploads/img/profile/'.$img_name;
        }
        Auth::user()->nom = $request->fname;
        Auth::user()->prenom = $request->lname;
        Auth::user()->telephone = $request->tele;
        Auth::user()->adresse = $request->adresse;
        Auth::user()->codePostale = $request->zipcode;
        Auth::user()->ville = $request->ville;
        Auth::user()->save();
        return back()->with('success', 'Votre profile a bien été modifié'  );
    }
}

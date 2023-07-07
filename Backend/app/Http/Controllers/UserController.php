<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{

    public function UserDetails()
    {
        $user = Auth::user();
        return response()->json(['success' => $user], 200);
    }

    public function updateProfile(Request $request)
    {
        $user = Auth::user();
        $validator = validator($request->only('email', 'nom', 'prenom', 'adresse', 'telephone', 'codePostale', 'ville'), [
            'nom' => 'required|string|max:20',
            'email' => 'email|required|unique:users,email,' . $user->id,
            'prenom' => 'required|string|max:20',
            'adresse' => 'required|string|max:255',
            'telephone' => 'required|max:12',
            'codePostale' => 'required|max:6',
            'ville' => 'required|string|max:20',
        ]);


        if ($validator->fails()) {

            return  response()->json($validator->errors()->all(), 400);
        }


       


        if ($request->password != "" && $request->oldpassword != ""  ) {
            $validatorpass = validator($request->only( 'password', 'password_confirmation','oldpassword'), [
                'password' => 'string|min:6|confirmed',
                'oldpassword' => 'string|min:6',
            ]);
            if ($validatorpass->fails()) {

                return  response()->json($validatorpass->errors()->all(), 400);
            }
            if (Hash::check($request->oldpassword, auth()->user()->password)) {
                $user->password = bcrypt(request('password'));
            }else {
                return  response()->json(['Votre Mot de passe incorrect'], 400);
            }
        }
        $user->nom = $request->nom;
        $user->prenom = $request->prenom;
        $user->adresse = $request->adresse;
        $user->telephone = $request->telephone;
        $user->codePostale = $request->codePostale;
        $user->ville = $request->ville;
        $user->email = $request->email;
        $user->save();

        $jsonError = response()->json($user, 200);
        return  $jsonError;
    }

        public function editGoogleMapsParam (Request $request) {
            $user = Auth::user();
            $validator = validator($request->only('lat', 'lng'), [
                'lat' => 'required',
                'lng' => 'required'
            ]);
            if ($validator->fails()) {
                return  response()->json($validator->errors()->all(), 400);
            }
            $user->lat = $request->lat;
            $user->lang = $request->lng;
            $user->save();
            return  response()->json($user, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
}

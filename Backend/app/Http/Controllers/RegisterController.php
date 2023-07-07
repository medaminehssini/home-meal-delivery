<?php

namespace App\Http\Controllers;

use App\User;
use App\Fournisseur;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{




    public function register(Request $request)
    {
        $validator = validator($request->only( 'type','email', 'nom', 'prenom', 'adresse', 'telephone', 'codePostale', 'ville', 'password', 'password_confirmation'), [
            'nom' => 'required|string|max:20',
            'prenom' => 'required|string|max:20',
            'adresse' => 'required|string|max:255',
            'telephone' => 'required|string|max:12',
            'codePostale' => 'required|string|max:6',
            'ville' => 'required|string|max:20',
            'password' => 'required|string|min:6|confirmed',
            'type' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }

        $data = request()->only('email', 'nom', 'prenom', 'adresse', 'telephone', 'codePostale', 'ville', 'password');

        
        
        if ( $request->type == 'fournisseur' ) {
            $validator = validator($request->all(), [
                'email' => 'required|string|email|max:255|unique:fournisseurs',
            ]);
            if ($validator->fails()) {
                return response()->json(['error' => $validator->errors()], 400);
            }
           
            $user = Fournisseur::create([
                'nom'        => $data['nom'],
                'prenom'     => $data['prenom'],
                'email'      => $data['email'],
                'adresse'    => $data['adresse'],
                'telephone'  => $data['telephone'],
                'codePostale' => $data['codePostale'],
                'ville'      => $data['ville'],
                'password' => bcrypt($data['password']),
            ]);
            return response()->json(['success' => 'created'], 200);
        }else {
  
            $validator = validator($request->all(), [
                'email' => 'required|string|email|max:255|unique:users',
            ]);
            if ($validator->fails()) {
                return response()->json(['error' => $validator->errors()], 400);
            }
            $user = User::create([
                'nom'        => $data['nom'],
                'prenom'     => $data['prenom'],
                'email'      => $data['email'],
                'adresse'    => $data['adresse'],
                'telephone'  => $data['telephone'],
                'codePostale' => $data['codePostale'],
                'ville'      => $data['ville'],
                'password' => bcrypt($data['password']),
            ]);
            $success['token'] =  $user->createToken('RegisterToken')->accessToken;
            return response()->json(['success' => $success], 200);
        }


        
    }


    public function login(Request $request)
    {

        $validator = validator($request->only('email', 'password'), [
            'email' => 'required|string|email|max:255',
            'password' => 'required|string|min:6',
        ]);
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 401);
        }
        if (Auth::attempt(['email' => request('email'), 'password' => request('password')])) {

            $user = User::find(Auth::user()->id);

            $success['token'] =  $user->createToken('LoginUser')->accessToken;

            return response()->json(['success' => $success],200);
        } else {
            return response()->json(['error' => 'Unauthorised'], 401);
        }
    }




}

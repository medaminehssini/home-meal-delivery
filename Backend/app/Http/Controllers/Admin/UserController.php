<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use Validator;
use Auth;
use Hash ;
use Yajra\Datatables\Datatables;
class UserController extends Controller
{
    public function listUser () {
        return view('admin.Client.listeClient');
    }
    public function getDataTable () {
        $users = User::select(['id','nom' ,'prenom' ,'image' ,'email' , 'adresse' ,'telephone' ,'ville' ,'codePostale' ,'created_at','updated_at']);

        return Datatables::of($users) ->addColumn('action', function ($user) {
            return '  <a href="'.url("/supprimer/client").'/'.$user->id.'" class="btn btn-xs btn-danger"><i class="glyphicon glyphicon-trash"></i> Supprimer</a> ';
        })
        ->make(true);
    }


    public function ajout (Request $request) {
        $validator =  Validator::make($request->all(), [
            'nom' => 'required|min:2|max:50',
            'prenom' => 'required|min:2|max:50',
            'email' => 'required|unique:users|max:255',
            'adresse' => 'required|min:2|max:255',
            'telephone' => 'required|min:2|max:14',
            'ville' => 'required|max:255',
            'codePostale' => 'required|max:255',
            'mot_de_passe' => 'required|confirmed|min:6|max:50',
            'image'=>'required|image|mimes:jpg,jpeg,png,gif|max:4000',
        ]);
        if ($validator->fails()) {
            return back()->with('errorAjouclient','d')
                        ->withErrors($validator)
                        ->withInput();
        }
        $img_name = time().'.'.$request->image->getClientOriginalExtension();
        $request->image->move(public_path('uploads/img/client'),$img_name);

            $client = new User();
            $client->image = 'uploads/img/client/'.$img_name;
            $client->nom = $request->nom;
            $client->prenom = $request->prenom;
            $client->email = $request->email;
            $client->password = Hash::make($request->mot_de_passe) ;
            $client->adresse = $request->adresse;
            $client->telephone = $request->telephone;
            $client->codePostale = $request->codePostale;   
            $client->ville = $request->ville;
            $client->save();

        return back()->with('success', 'Le client a bien été créé'  );

    }

    public function modifier (Request $request , $id) {
        $client =  User::find($id);
        $validator = Validator::make($request->all(), [
            'nomedit' => 'required|min:2|max:50',
            'prenomedit' => 'required|min:2|max:50',
            'emailedit' => 'required|max:255|unique:users,email,'.$client->id,
            'adresseedit' => 'required|min:2|max:255',
            'telephoneedit' => 'required|min:2|max:50',
            'villeedit' => 'required|max:255',
            'codePostaleedit' => 'required|max:255',
            'imageedit'=>'image|mimes:jpg,jpeg,png,gif|max:4000',

        ]);
        if ($validator->fails()) {
            return back()->with('errorModifierClient','d')
                        ->withErrors($validator)
                        ->withInput();
        }

        if($request->imageedit != '' ){
            $img_name = time().'.'.$request->imageedit->getClientOriginalExtension();
             $request->imageedit->move(public_path('uploads/img/client'),$img_name);
             $client->image = 'uploads/img/client/'.$img_name;

        }
            $client->nom = $request->nomedit;
            $client->prenom = $request->prenomedit;
            $client->email = $request->emailedit;
            $client->adresse = $request->adresseedit;
            $client->telephone = $request->telephoneedit;
            $client->codePostale = $request->codePostaleedit;   
            $client->ville = $request->villeedit;
            if($request->mot_de_passe != ''){
                $validator = Validator::make($request->all(), [
                    'mot_de_passe' => 'confirmed|min:6|max:50',
                ]);
                if ($validator->fails()) {
                    return back()->with('errorModifierClient','d')
                                ->withErrors($validator)
                                ->withInput();
                }
                $client->password = Hash::make($request->mot_de_passe) ;
            }
        
            $client->save();

        return back()->with('success', 'Le client a bien été modifié'  );

    }

    public function supprimer ($id) {
        $client = User::find($id);
        $client->delete();
        return back()->with('success', 'Le client a bien été supprimé');
    }
}

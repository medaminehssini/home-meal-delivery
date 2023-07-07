<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use Auth;
use Hash ;
use Yajra\Datatables\Datatables;
use App\Transporteur;
use App\Commande;
class TransporteurController extends Controller
{
    public function listTransporteur () {
        return view('admin.transporteur.transporteur');
    }
    public function getDataTable () {
        $transporteurs = Transporteur::get();

        return Datatables::of($transporteurs) ->addColumn('action', function ($transporteur) {
            return '<button type="button" style="margin-bottom:5px" onclick=\'setInfo('.$transporteur.')\'   data-toggle="modal" data-target="#editTransporteur" class="btn btn-xs btn-info"><i class="glyphicon glyphicon-edit"></i> Edit</button>
            <a href="'.url("/supprimer/transporteur").'/'.$transporteur->id.'" class="btn btn-xs btn-danger"><i class="glyphicon glyphicon-trash"></i> Supprimer</a>
            ';
        })
        ->addColumn('statut', function ($transporteur) {
            $commandes = true;
            $message =  '';
            foreach ($transporteur->commande as $key => $value) {
               if($value->statut != 3 ) 
                     $commandes = false;
            }
            if($commandes ) 
            {
                $message =   $message .'<button desabled style = "width:90% ; margin: 5px ; cursor: no-drop;"  class="btn btn-xs btn-success">Desponible</button><br>';
            }
            else if (!$commandes)  {
                $message =   $message . '<button desabled style = "cursor: no-drop;width:90% ; margin: 5px"  class="btn btn-xs btn-warning">Non desponible </button><br>';
            }
            return $message;
        })
        ->rawColumns(['statut', 'action'])
        ->make(true);
    }

    public function getDataTableCommande ($id) {
        $transporteurs = Commande::where('id_transporteur' ,$id )->with('user')->get();
        return Datatables::of($transporteurs)
        ->addColumn('action', function ($commandes) {
            $message = '';
            if($commandes->statut == 1 ) 
            {
                $message =   $message .'<button desabled style = "width:90% ; margin: 5px ; cursor: no-drop;"  class="btn btn-xs btn-success">Acceptée</button><br>';
            }
            else if ($commandes->statut == 2)  {
                $message =   $message . '<button desabled style = "cursor: no-drop;width:90% ; margin: 5px"  class="btn btn-xs btn-danger">Refusée</button><br>';
            }
            else if ($commandes->statut == 4)  {
                $message =   $message . '<button desabled style = "cursor: no-drop;width:90% ; margin: 5px"  class="btn btn-xs btn-success">Fermé</button><br>';
            }
            else if ($commandes->statut == 3)  {
                $message =   $message . '<button desabled style = "cursor: no-drop;width:90% ; margin: 5px"  class="btn btn-xs btn-success">Livré</button><br>';
            }
            else {
                $message =   $message .'<button desabled style = "cursor: no-drop;width:90% ; margin: 5px" class="btn btn-xs btn-warning">attendre</button><br>';
            }
            return $message ; 
        })
        ->make(true);
    }


    public function ajout (Request $request) {
        $validator =  Validator::make($request->all(), [
            'nom' => 'required|min:2|max:50',
            'prenom' => 'required|min:2|max:50',
            'email' => 'required|unique:transporteur|max:255',
            'adresse' => 'required|min:2|max:255',
            'telephone' => 'required|min:2|max:14',
            'ville' => 'required|max:255',
            'mot_de_passe' => 'required|confirmed|min:6|max:50',
        ]);
        if ($validator->fails()) {
            return back()->with('errorAjoutTransporteur','d')
                        ->withErrors($validator)
                        ->withInput();
        }


            $Transporteur = new Transporteur();
            $Transporteur->nom = $request->nom;
            $Transporteur->prenom = $request->prenom;
            $Transporteur->email = $request->email;
            $Transporteur->password = Hash::make($request->mot_de_passe) ;
            $Transporteur->adresse = $request->adresse;
            $Transporteur->telephone = $request->telephone;
            $Transporteur->ville = $request->ville;
            $Transporteur->save();

        return back()->with('success', 'Le Transporteur a bien été créé'  );

    }

    public function modifier (Request $request , $id) {
        $Transporteur =  Transporteur::find($id);
        $validator = Validator::make($request->all(), [
            'nomedit' => 'required|min:2|max:50',
            'prenomedit' => 'required|min:2|max:50',
            'emailedit' => 'required|max:255|unique:transporteur,email,'.$Transporteur->id,
            'adresseedit' => 'required|min:2|max:255',
            'telephoneedit' => 'required|min:2|max:50',
            'villeedit' => 'required|max:255',

        ]);
        if ($validator->fails()) {
            return back()->with('errorModifierTransporteur','d')
                        ->withErrors($validator)
                        ->withInput();
        }

            $Transporteur->nom = $request->nomedit;
            $Transporteur->prenom = $request->prenomedit;
            $Transporteur->email = $request->emailedit;
            $Transporteur->adresse = $request->adresseedit;
            $Transporteur->telephone = $request->telephoneedit;
            $Transporteur->ville = $request->villeedit;
            if($request->mot_de_passe != ''){
                $validator = Validator::make($request->all(), [
                    'mot_de_passe' => 'confirmed|min:6|max:50',
                ]);
                if ($validator->fails()) {
                    return back()->with('errorModifierTransporteur','d')
                                ->withErrors($validator)
                                ->withInput();
                }
                $Transporteur->password = Hash::make($request->mot_de_passe) ;
            }
        
            $Transporteur->save();

        return back()->with('success', 'Le Transporteur a bien été modifié'  );

    }

    public function supprimer ($id) {
        $Transporteur = Transporteur::find($id);
        $Transporteur->delete();
        return back()->with('success', 'Le Transporteur a bien été supprimé');
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Commande;
use Validator;
use Auth;
use Hash ;
use Yajra\Datatables\Datatables;
class CommandeController extends Controller
{
    public function listCommande () {

        return view('admin.commande.listeCommande'); 

    }
    public function getDataTable () {
        $commandes = Commande::with(['user','coupon'])->get();
        return Datatables::of($commandes)
        ->addColumn('etat', function ($commandes) {
            $message = '';
            if($commandes->statut == 1 ) 
            {
                $message =   $message .'<button desabled style = "width:90% ; margin: 5px ; cursor: no-drop;"  class="btn btn-xs btn-success">Acceptée</button><br>';
            }
            else if ($commandes->statut == 4)  {
                $message =   $message . '<button desabled style = "cursor: no-drop;width:90% ; margin: 5px"  class="btn btn-xs btn-danger">Refusée</button><br>';
            }
            else if ($commandes->statut == 2)  {
                $message =   $message . '<button desabled style = "cursor: no-drop;width:90% ; margin: 5px"  class="btn btn-xs btn-warning">en cour de livraison</button><br>';
            }
            else if ($commandes->statut == 3)  {
                $message =   $message . '<button desabled style = "cursor: no-drop;width:90% ; margin: 5px"  class="btn btn-xs btn-success">Livré</button><br>';
            }
            else {
                $message =   $message .'<button desabled style = "cursor: no-drop;width:90% ; margin: 5px" class="btn btn-xs btn-warning">attendre</button><br>';
            }
            return $message ; 
        })
        ->addColumn('action', function ($commande) {
            if($commande->statut == 0)
            return '<a href="'.url("/accepter/commande").'/'.$commande->id.'" class="btn btn-xs btn-success"><i class="fa fa-check"></i> Accepter</a>
                      <a href="'.url("/refuser/commande").'/'.$commande->id.'" class="btn btn-xs btn-danger"><i class="glyphicon glyphicon-trash"></i> Refuser</a> ';
            else  if($commande->statut == 1)
              return  '<a href="'.url("/refuser/commande").'/'.$commande->id.'" class="btn btn-xs btn-danger"><i class="glyphicon glyphicon-trash"></i> Refuser</a> ';
            else  if($commande->statut == 4)
            return '<a href="'.url("/accepter/commande").'/'.$commande->id.'" class="btn btn-xs btn-success"><i class="fa fa-check"></i> Accepter</a>';
                    })
        ->rawColumns(['etat', 'action'])
        ->make(true);
    }

    public function getItemDataTable ($id) {
        $commandes = Commande::find($id);
        $commandes =$commandes->item()->with('repas');
        return Datatables::of($commandes)  ->addColumn('action', function ($commandes) {
            return '<img style="    width: 50px;" src= "'.url($commandes->repas->image).'">
            ';
        })
        ->addColumn('types', function ($commandes) {
            if ($commandes->repas->type == 1) {
                return '<button type="button" style="background-color: #e8500e !important; border-color: #e8500e;"  class="btn btn-xs btn-info">Repas</button>';
            }else 
            return '<button type="button" style="background-color: #fcd109 !important; border-color: #fcd109;"   class="btn btn-xs btn-info">Pack</button>';
        })
        ->addColumn('etat', function ($commandes) {
            $message = '';
            
            if($commandes->etat == 1 ) 
            {
                $message =   $message .'<button desabled style = "width:90% ; margin: 5px ; cursor: no-drop;"  class="btn btn-xs btn-success">Accepté</button><br>';
            }
            else if ($commandes->etat == 2)  {
                $message =   $message . '<button desabled style = "cursor: no-drop;width:90% ; margin: 5px"  class="btn btn-xs btn-danger">Refusé</button><br>';
            }
            else {
                $message =   $message .'<button desabled style = "cursor: no-drop;width:90% ; margin: 5px" class="btn btn-xs btn-warning">attendre</button><br>';
            }
            return $message ; 
        })
        ->addColumn('restaurant', function ($commandes) {
            $message = $commandes->repas->restaurant->nom;
            return $message ; 
        })
        ->rawColumns(['types', 'action' , 'etat' , 'restaurant'])
        ->make(true);
    }


    public function ajout (Request $request) {
        $validator =  Validator::make($request->all(), [
            'nom' => 'required|min:2|max:50',
            'prenom' => 'required|min:2|max:50',
            'email' => 'required|unique:commande|max:255',
            'adresse' => 'required|min:2|max:255',
            'telephone' => 'required|min:2|max:14',
            'ville' => 'required|max:255',
            'codePostale' => 'required|max:255',
            'mot_de_passe' => 'required|confirmed|min:6|max:50',
            'image'=>'required|image|mimes:jpg,jpeg,png,gif|max:4000',
        ]);
        if ($validator->fails()) {
            return back()->with('errorAjoutCommande','d')
                        ->withErrors($validator)
                        ->withInput();
        }
        $img_name = time().'.'.$request->image->getClientOriginalExtension();
        $request->image->move(public_path('uploads/img/commande'),$img_name);

            $commande = new Commande();
            $commande->image = 'uploads/img/commande/'.$img_name;
            $commande->nom = $request->nom;
            $commande->prenom = $request->prenom;
            $commande->email = $request->email;
            $commande->password = Hash::make($request->mot_de_passe) ;
            $commande->adresse = $request->adresse;
            $commande->telephone = $request->telephone;
            $commande->codePostale = $request->codePostale;   
            $commande->ville = $request->ville;
            $commande->save();

        return back()->with('success', 'Le Commande a bien été créé'  );

    }



    public function accepter ($id) {
        $commande = Commande::find($id);
        $commande->statut = 1;
        $commande->save();
        return back()->with('success', 'Le Commande a bien été accepter');
    }
    public function refuser ($id) {
        $commande = Commande::find($id);
        $commande->statut = 4;
        $commande->save();
        return back()->with('success', 'Le Commande a bien été refusé');
    }
}

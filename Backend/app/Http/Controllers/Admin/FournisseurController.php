<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Fournisseur;
use App\Restaurant;
use Validator;
use Auth;
use Hash ;
use Yajra\Datatables\Datatables;
class FournisseurController extends Controller
{
    public function listFournisseur () {
        return view('admin.fournisseur.listefournisseur');
    }
    public function getDataTable () {
        
        if(request()->fournisseur == '' || request()->fournisseur == 'all' )
             $fournisseurs = Fournisseur::select(['id','nom' ,'prenom' ,'image' ,'email' , 'adresse' ,'telephone' ,'ville' ,'codePostale' ,'created_at','updated_at']);
        else
            $fournisseurs = Fournisseur::select(['id','nom' ,'prenom' ,'image' ,'email' , 'adresse' ,'telephone' ,'ville' ,'codePostale' ,'created_at','updated_at'])->where('id',Restaurant::find(request()->fournisseur)->id_fournisseur)->get();

        if(request()->fournisseur == 'all'  )
            Restaurant::where('notificationStatut' , 0)->update(['notificationStatut'=> 1]);
        if(request()->fournisseur != 'all' && request()->fournisseur != '')
            Restaurant::where('id' , request()->fournisseur)->update(['notificationStatut'=> 1]);
        
        return Datatables::of($fournisseurs) ->addColumn('action', function ($fournisseur) {
            return '<button style="    margin-bottom: 10px;" type="button" onclick=\'setInfo('.$fournisseur.')\'   data-toggle="modal" data-target="#editFournisseur" class="btn btn-xs btn-info"><i class="glyphicon glyphicon-edit"></i> Edit</button>
            <a href="'.url("/supprimer/fournisseur").'/'.$fournisseur->id.'" class="btn btn-xs btn-danger"><i class="glyphicon glyphicon-trash"></i> Supprimer</a>
            ';
        })
        ->make(true);
    }
 

    public function ajout (Request $request) {
        $validator =  Validator::make($request->all(), [
            'nom' => 'required|min:2|max:50',
            'prenom' => 'required|min:2|max:50',
            'email' => 'required|unique:fournisseurs|max:255',
            'adresse' => 'required|min:2|max:255',
            'telephone' => 'required|min:2|max:14',
            'ville' => 'required|max:255',
            'codePostale' => 'required|max:255',
            'mot_de_passe' => 'required|confirmed|min:6|max:50',
            'image'=>'required|image|mimes:jpg,jpeg,png,gif|max:4000',
        ]);
        if ($validator->fails()) {
            return back()->with('errorAjoutFournisseur','d')
                        ->withErrors($validator)
                        ->withInput();
        }
        $img_name = time().'.'.$request->image->getClientOriginalExtension();
        $request->image->move(public_path('uploads/img/fournisseur'),$img_name);

            $fournisseur = new Fournisseur();
            $fournisseur->image = 'uploads/img/fournisseur/'.$img_name;
            $fournisseur->nom = $request->nom;
            $fournisseur->prenom = $request->prenom;
            $fournisseur->email = $request->email;
            $fournisseur->password = Hash::make($request->mot_de_passe) ;
            $fournisseur->adresse = $request->adresse;
            $fournisseur->telephone = $request->telephone;
            $fournisseur->codePostale = $request->codePostale;   
            $fournisseur->ville = $request->ville;
            $fournisseur->save();

        return back()->with('success', 'Le fournisseur a bien été créé'  );

    }

    public function modifier (Request $request , $id) {
        $fournisseur =  Fournisseur::find($id);
        $validator = Validator::make($request->all(), [
            'nomedit' => 'required|min:2|max:50',
            'prenomedit' => 'required|min:2|max:50',
            'emailedit' => 'required|max:255|unique:fournisseurs,email,'.$fournisseur->id,
            'adresseedit' => 'required|min:2|max:255',
            'telephoneedit' => 'required|min:2|max:50',
            'villeedit' => 'required|max:255',
            'codePostaleedit' => 'required|max:255',
            'imageedit'=>'image|mimes:jpg,jpeg,png,gif|max:4000',

        ]);
        if ($validator->fails()) {
            return back()->with('errorModifierFournisseur','d')
                        ->withErrors($validator)
                        ->withInput();
        }

        if($request->imageedit != '' ){
            $img_name = time().'.'.$request->imageedit->getClientOriginalExtension();
             $request->imageedit->move(public_path('uploads/img/fournisseur'),$img_name);
             $fournisseur->image = 'uploads/img/fournisseur/'.$img_name;

        }
            $fournisseur->nom = $request->nomedit;
            $fournisseur->prenom = $request->prenomedit;
            $fournisseur->email = $request->emailedit;
            $fournisseur->adresse = $request->adresseedit;
            $fournisseur->telephone = $request->telephoneedit;
            $fournisseur->codePostale = $request->codePostaleedit;   
            $fournisseur->ville = $request->villeedit;
            if($request->mot_de_passe != ''){
                $validator = Validator::make($request->all(), [
                    'mot_de_passe' => 'confirmed|min:6|max:50',
                ]);
                if ($validator->fails()) {
                    return back()->with('errorModifierFournisseur','d')
                                ->withErrors($validator)
                                ->withInput();
                }
                $fournisseur->password = Hash::make($request->mot_de_passe) ;
            }
        
            $fournisseur->save();

        return back()->with('success', 'Le Fournisseur a bien été modifié'  );

    }

    public function supprimer ($id) {
        $fournisseur = Fournisseur::find($id);
        $fournisseur->delete();
        return back()->with('success', 'Le Fournisseur a bien été supprimé');
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Abonnement;
use App\OptionAbonnement as Service;
use Validator;
use Auth;
use Hash ;
use DB;
use Yajra\Datatables\Datatables;
class AbonnementController extends Controller
{
    public function listAbonnement () {
        $service = Service::get();
        return view('admin.fournisseur.abonnement')->with('services' , $service);
    }
    public function getDataTable () {
        $Abonnements = Abonnement::with('service')->get();
        return Datatables::of($Abonnements) ->addColumn('action', function ($Abonnement) {
            return '<button  type="button" onclick=\'setInfo('.$Abonnement.')\'   data-toggle="modal" data-target="#editAbonnement" class="btn btn-xs btn-info"><i class="glyphicon glyphicon-edit"></i> Edit</button>
            <a href="'.url("/supprimer/abonnement").'/'.$Abonnement->id.'" class="btn btn-xs btn-danger"><i class="glyphicon glyphicon-trash"></i> Supprimer</a>
            ';
        })
        ->make(true);
    }


    public function ajout (Request $request) {
       
        $validator =  Validator::make($request->all(), [
            'nom' => 'required|min:2|max:50',
            'prix' => 'required|max:50',
            'nbr_mois' => 'required|max:50',
            'services' => 'required|min:1|max:20',
        ]);
        if ($validator->fails()) {
            return back()->with('errorAjoutAbonnement','d')
                        ->withErrors($validator)
                        ->withInput();
        }
            $Abonnement = new Abonnement();
            $Abonnement->nom = $request->nom;
            $Abonnement->prix = $request->prix;
            $Abonnement->nbr_mois = $request->nbr_mois;
            $Abonnement->save();
            foreach ($request->services as $service) {
                DB::insert('insert into service_abonnement (abonnement_id, service_id  ) values (?, ?)', [$Abonnement->id, $service]);
            }

        return back()->with('success', 'Le Abonnement a bien été créé'  );

    }

    public function modifier (Request $request , $id) {
        $Abonnement =  Abonnement::find($id);
        $validator =  Validator::make($request->all(), [
            'nomedit' => 'required|min:2|max:50',
            'prix_edit' => 'required|max:50',
            'nbr_mois_edit' => 'required|max:50',
            'services' => 'required|min:1|max:20',
        ]);
        if ($validator->fails()) {
            return back()->with('errorModifierAbonnement','d')
                        ->withErrors($validator)
                        ->withInput();
        }

            $Abonnement->service()->sync($request->services);
            $Abonnement->nom = $request->nomedit;
            $Abonnement->prix = $request->prix_edit;
            $Abonnement->nbr_mois = $request->nbr_mois_edit;
            $Abonnement->save();

        return back()->with('success', 'Le Abonnement a bien été modifié'  );

    }

    public function supprimer ($id) {
        $Abonnement = Abonnement::find($id);
        $Abonnement->delete();
        return back()->with('success', 'Le Abonnement a bien été supprimé');
    }
}

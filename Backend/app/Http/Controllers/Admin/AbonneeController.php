<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Abonnee;
use App\Fournisseur;
use App\Abonnement;
use App\Coupon;
use App\OptionAbonnement as Service;
use Validator;
use Auth;
use Hash ;
use DB;
use Carbon;
use Yajra\Datatables\Datatables;
class AbonneeController extends Controller
{
    public function listAbonnee  () {
        $Fournisseur = Fournisseur::get();
        $Abonnement = Abonnement::get();
        $Coupon = Coupon::get();
        return view('admin.fournisseur.abonnee')->with(['fournisseurs' => $Fournisseur,'abonnements' => $Abonnement ,'coupon' => $Coupon]);
    }
    public function getDataTable () {
        $Abonnemees = Abonnee::with(['abonnement' ,'fournisseur' , 'coupon'])->get();
       
        return Datatables::of($Abonnemees)
        ->addColumn('status', function ($Abonnee) {
            $message = '';
            if($Abonnee->etat == 1 ) 
            {
                $message =   $message .'<button desabled style = "width:90% ; margin: 5px ; cursor: no-drop;"  class="btn btn-xs btn-success">Acceptée</button><br>';
            }
            else if ($Abonnee->etat == 2)  {
                $message =   $message . '<button desabled style = "cursor: no-drop;width:90% ; margin: 5px"  class="btn btn-xs btn-danger">Refusée</button><br>';
            }else {
                $message =   $message .'<button desabled style = "cursor: no-drop;width:90% ; margin: 5px" class="btn btn-xs btn-warning">attendre</button><br>';
            }
            return $message ; 
        })
        ->addColumn('action', function ($Abonnee) {
            $message = '' ; 

            if($Abonnee->etat == 1 ) 
            {        
                        $message =  $message . '<a  styple="margin: 5px" href="'.url("/annuler/abonnee").'/'.$Abonnee->id.'" class="btn btn-xs btn-danger">Annuler</a><br><br>';
            }else if ($Abonnee->etat == 2)  {  
                              $message =  $message .  '<a styple="margin: 5px"  href="'.url("/accepter/abonnee").'/'.$Abonnee->id.'" class="btn btn-xs btn-success"> Accepter</a><br><br>';
            }else { 
                  $message =  $message . '<a  style="margin: 5px" href="'.url("/accepter/abonnee").'/'.$Abonnee->id.'" class="btn btn-xs btn-success"> Accepter</a>';
                $message = $message . '<a  style="margin: 5px" href="'.url("/refuser/abonnee").'/'.$Abonnee->id.'" class="btn btn-xs btn-danger">Refuser</a><br><br>';
            }
            $message = $message . '
            <a href="'.url("/supprimer/abonnee").'/'.$Abonnee->id.'" class="btn btn-xs btn-danger"><i class="glyphicon glyphicon-trash"></i> Supprimer</a> 
            ' ;
            return $message;
        })

        ->rawColumns(['status', 'action'])
        ->make(true);
    }


    public function ajout (Request $request) {
        $validator =  Validator::make($request->all(), [
            'fournisseur' => 'required|max:50',
            'abonnemet' => 'required|max:50',
            'coupon' => 'required|max:50',
            'nbr_mois' => 'required|min:1|max:20',
        ]);

        $Coupon = Coupon::find($request->coupon) ;
        $abonnement = Abonnement::find($request->abonnemet) ;
        $prix = ($abonnement->prix - $abonnement->prix * $Coupon->remise /100)*$request->nbr_mois ; 
        if ($validator->fails()) {
            return back()->with('errorAjoutAbonnee','d')
                        ->withErrors($validator)
                        ->withInput();
        }
            $Abonnee = new Abonnee();
            $Abonnee->id_fournisseur = $request->fournisseur;
            $Abonnee->id_abonnement = $request->abonnemet;
            $Abonnee->id_coupon = $request->coupon;
            $Abonnee->nbr_mois = $request->nbr_mois;
            $Abonnee->prix = $prix;
            $Abonnee->etat = 1;
            $Abonnee->save();

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

    public function refuserAbonnee ($id) {
        $Abonnee = Abonnee::find($id);
        $Abonnee->etat = 2 ;
        $Abonnee->save();
        return back()->with('success', 'L\'Abonnee a été refuser');
    }

    public function AccepterAbonnee ($id) {
        $Abonnee = Abonnee::find($id);
        $Abonnee->etat = 1 ;
        $Abonnee->date_fin = Carbon\Carbon::now()->addMonths($Abonnee->nbr_mois) ;
        $Abonnee->save();
        return back()->with('success', 'L\'Abonnee a été refuser');
    }
}

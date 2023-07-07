<?php

namespace App\Http\Controllers\Transporteur;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Commande;
use App\Restaurant;
use Validator;
use Auth;
use Hash ;
use Yajra\Datatables\Datatables;
class CommandeController extends Controller
{
    public function listCommande () {
        return view('transporteur.commande.liste'); 
    }

    public function listCommandeHistorique () {
        return view('transporteur.commande.listehistorique'); 
    }
    function verifExiste ($rest , $item) {
        foreach ($rest as $key => $value) {
            if ($value == $item )
                return false ; 
        }
        return true;
    }
    function getRestaurant ($commandes ) {
        $restau = [] ; 
        $i = 0; 
        foreach ($commandes as  $commande) {
            foreach ($commande->repas as $key => $value) {
                if ($this->verifExiste($restau,$value->restaurant->id)) {
                    $restau[$i]= $value->restaurant->id;
                    $i++;
                }
   
            }
            foreach ($commande->pack as $key => $value) {
                if ($this->verifExiste($restau,$value->restaurant->id)) {
                    $restau[$i]= $value->restaurant->id;
                    $i++;
                }
            }
            $restaurant = Restaurant::whereIn('id',$restau)->get();
            $commande->rest = $restaurant;
            $restau = [] ; 
            $i = 0; 
        }
        return $commandes;
    }
    public function  getDataTable () {
        
        if(request()->commande != '')
            $commandes =   Commande::with(['user','coupon'])
             ->where(['id'=>request()->commande  , 'statut' => 1 , 'ville' =>Auth::guard('transporteur')->user()->ville])
             ->get();
        else 
        $commandes =   Commande::with(['user','coupon'])
         ->where(['statut' => 1 , 'ville' =>Auth::guard('transporteur')->user()->ville])
         ->get();
        $commandes =  $this->getRestaurant($commandes);
       
        return Datatables::of($commandes)
        ->addColumn('action', function ($commande) {
    
                return '<a href="'.url("transporteur/accepter/commande").'/'.$commande->id.'" class="btn btn-xs btn-success"><i class="fa fa-check"></i> Accepter</a> ';
                    })
        ->addColumn('adresseMap', function ($commande) {
    
            return '<button onclick=\'initialize('.$commande->lat.' ,' .$commande->lng.' ,' . $commande->rest.')\'  type="button" class="btn btn-success"   data-toggle="modal" data-target="#openmaps"  >Voir Map</button>';
        })

                    
        ->rawColumns(['action' , 'adresseMap'])
        ->make(true);
    }


    public function getDataTableHistorique () {
        $commandes = 
        Commande::with(['user','coupon'])
         ->where(['id_transporteur' =>Auth::guard('transporteur')->user()->id])
         ->get();
        return Datatables::of($commandes)
        ->addColumn('action', function ($commande) {
            if($commande->statut == 2)
              return '<a href="'.url("transporteur/livre/commande").'/'.$commande->id.'" class="btn btn-xs btn-success"><i class="fa fa-check"></i> Livré</a>
                      <a href="'.url("transporteur/annuler/commande").'/'.$commande->id.'" class="btn btn-xs btn-danger"><i class="fa fa-close"></i> Annuler</a> ';      
            else {
                return '<button desabled style = "cursor: no-drop;width:90% ; margin: 5px"  class="btn btn-xs btn-success">Livré</button><br>';
            }
        
            })
        ->rawColumns(['action'])
        ->make(true);
    }
    public function getItemDataTable ($id) {
        $commandes = Commande::find($id);
        $repas = $commandes->repas;
        $pack = $commandes->pack;
        foreach ($pack as $key => $value) {
           $repas[$repas->count()+$key] =  $value ;
        }
        $commandes = $repas ;
        return Datatables::of($commandes)  
        ->addColumn('action', function ($commandes) {
            if ($commandes->type == 1) {
                return '<button type="button" style="background-color: #e8500e !important; border-color: #e8500e;"  class="btn btn-xs btn-info">Repas</button>';
            }else 
            return '<button type="button" style="background-color: #fcd109 !important; border-color: #fcd109;"   class="btn btn-xs btn-info">Pack</button>';
        })
        ->rawColumns(['action'])
        ->make(true);
    }






    public function accepter ($id) {
        
        $commande = Commande::where([
            'id_transporteur' => Auth::guard('transporteur')->user()->id,
            'statut' => 2
        ])->get();
        if($commande->count() == 0) {
            $commande = Commande::find($id);
            $commande->statut = 2;
            $commande->id_transporteur =  Auth::guard('transporteur')->user()->id ;
            $commande->save();
            return back()->with('success', 'Le Commande a bien été accepter');
        }
        return back()->with('warning', 'Vous avez déja une commande à livrer ');


    }

    public function livre ($id) {
        $commande = Commande::find($id);
        if($commande->id_transporteur ==  Auth::guard('transporteur')->user()->id) {
            $commande->statut = 3;
            $commande->save();
            return back()->with('success', 'Le Commande a bien été Modifié');
        }
        return back();
    }
    public function annuler ($id) {
        
        $commande = Commande::find($id);

        if($commande->id_transporteur ==  Auth::guard('transporteur')->user()->id) {
            $commande->statut = 1;
            $commande->id_transporteur = null ;
            $commande->save();
            return back()->with('success', 'Le Commande a bien été Modifié');
        }
    }
}

<?php

namespace App\Http\Controllers\Fournisseur;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Fournisseur;
use App\Commande;
use Auth;
use Yajra\Datatables\Datatables;
class CommandeController extends Controller
{
    public function index () {
        return view('fournisseur.commande.listeCommande');
    }
    public function getDataTable () {
        $commandes =  Commande::with('repas','user')->get();
        $fourncommande = [];
        $i  =0;
        foreach ($commandes as  $commande) {
            
           foreach ($commande->repas as $repas) {
            if( $repas->restaurant->fournisseur->id == Auth::user()->id) {
                $fourncommande[$i] = $commande;
                $i++;
                break ;
            }
           }
            
                
        }
      //  return $fourncommande;
        return Datatables::of($fourncommande)  
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
            $verif = 0 ; 
            foreach ($commande->item as  $item) {
                if( $item->repas->restaurant->fournisseur->id == Auth::user()->id && $item->etat != 0 ) {
                    
                    $verif =$item->etat ;
                    break ;
                }
            }
            if($commande->statut == 0){
                    if($verif == 0)
                    return '<a href="'.url("fournisseur/accepter/commande").'/'.$commande->id.'" class="btn btn-xs btn-success"><i class="fa fa-check"></i> Accepter</a>
                            <a href="'.url("fournisseur/refuser/commande").'/'.$commande->id.'" class="btn btn-xs btn-danger"><i class="glyphicon glyphicon-trash"></i> Refuser</a> ';
                    else  if($verif == 2)
                    return  '<button desabled style = "cursor: no-drop;width:90% ; margin: 5px"  class="btn btn-xs btn-danger">Refusé</button>';
                    else  
                    return '<button desabled style = "width:90% ; margin: 5px ; cursor: no-drop;"  class="btn btn-xs btn-success">Accepté</button>';
           }     
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

    
    public function accepter ($id) {
        $commande =  Commande::find($id);

        foreach ($commande->item as $item) {
            if( $item->repas->restaurant->fournisseur->id == Auth::user()->id) {
                $item->etat = 1;
                $item->save();
            }
        }
        
        $verif = true;
        foreach ($commande->item as $item) {
            if( $item->etat != 1) {
                $verif = false;
            }
        }
        if ($verif) {
            $commande->statut = 1 ;
            $commande->save();
        }
        return back()->with('success', 'Le Commande a bien été accepté');
    }

    public function refuser ($id) {
        $commande =  Commande::find($id);
        foreach ($commande->item as $item) {
            if( $item->repas->restaurant->fournisseur->id == Auth::user()->id) {
                $item->etat = 2;
                $item->save();
            }
        }
       
            $commande->statut = 4 ;
            $commande->save();
        return back()->with('success', 'Le Commande a bien été refusé');
    }


}

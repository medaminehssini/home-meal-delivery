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
class RestaurantController extends Controller
{
    public function getDataTable ($id) {
        $fournisseurs = Fournisseur::find($id)->restaurant;

        return Datatables::of($fournisseurs)
        ->addColumn('etats', function ($restaurant) {
            $message = '';
            if($restaurant->etat == 1 ) 
            {
                $message =   $message .'<button desabled style = " margin: 5px ; cursor: no-drop;"  class="btn btn-xs btn-success">Acceptée</button><br>';
            }
            else if ($restaurant->etat == 2)  {
                $message =   $message . '<button desabled style = "cursor: no-drop;margin: 5px"  class="btn btn-xs btn-danger">Refusée</button><br>';
            }else {
                $message =   $message .'<button desabled style = "cursor: no-drop; margin: 5px" class="btn btn-xs btn-warning">attendre</button><br>';
            }
            return $message ; 
        })
        ->addColumn('img', function ($restaurant) {
            return '<img style="    width: 50px;" src= "'.url($restaurant->logo).'">
            ';
        })
         ->addColumn('action', function ($restaurant) {
            $message = '' ; 

            if($restaurant->etat == 1 ) 
            {        
                        $message =  $message . '<button  type="button" onclick=\'setInfoRefuser('.$restaurant.')\'   data-toggle="modal" data-target="#refuserRestaurant" class="btn btn-xs btn-info"><i class="fa fa-times-circle-o"></i> Refuser</button>';
            }else if ($restaurant->etat == 2)  {  
                              $message =  $message .  '<a styple="margin: 5px"  href="'.url("/accepter/restaurant").'/'.$restaurant->id.'" class="btn btn-xs btn-success"><i class="fa fa-check"></i> Accepter</a><br><br>';
            }else { 
                  $message =  $message . '<a  style="margin: 5px" href="'.url("/accepter/restaurant").'/'.$restaurant->id.'" class="btn btn-xs btn-success"><i class="fa fa-check"></i> Accepter</a>';
                $message = $message . '<button  type="button" onclick=\'setInfoRefuser('.$restaurant.')\'   data-toggle="modal" data-target="#refuserRestaurant" class="btn btn-xs btn-info"><i class="fa fa-times-circle-o"></i> Refuser</button>';
            }
            return $message;
        })
        ->rawColumns(['etats' , 'img', 'action'])
        ->make(true);
    }
    public function accepter ($id) {
        $restaurant = Restaurant::find($id);
        if($restaurant != '') {
            $restaurant->etat = 1 ;
            $restaurant->notificationStatut = 2 ;
            $restaurant->note = null ;
            $restaurant->save();
            return back()->with('success', 'Le restaurant a été Acceptee');
        }else{
            abort(404);
        }

    }

    public function refuser ($id) {
        $validator =  Validator::make(request()->all(), [
            'note' => 'required|min:2|max:50',

        ]);
        if ($validator->fails()) {
            return  back()->with('error', 'note et obligatoire');
        }

        $restaurant = Restaurant::find($id);
    if( $restaurant != '') {
        $restaurant->etat = 2 ;
        $restaurant->notificationStatut = 2 ;
        $restaurant->note = request()->note ;
        $restaurant->save();
        return back()->with('success', 'Le restaurant a été Refusée');
    }else {
        abort(404);
    }

    }
}

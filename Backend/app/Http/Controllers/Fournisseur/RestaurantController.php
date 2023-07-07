<?php

namespace App\Http\Controllers\Fournisseur;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Fournisseur;
use Validator;
use Auth;
use Hash ;
use App\Restaurant;
use Yajra\Datatables\Datatables;
class RestaurantController extends Controller
{
    public function listeRestaurants  () {
        return view('fournisseur.restaurant.listeRestaurant');
    }
    public function getDataTable () {
        if(request()->restaurant == '' || request()->restaurant == 'all' )
            $restaurants = Fournisseur::find(Auth::guard('fournisseur')->user()->id)->restaurant;
        else
            $restaurants = Restaurant::where(['id' => request()->restaurant , 'id_fournisseur' =>Auth::guard('fournisseur')->user()->id])->get();

        if(request()->restaurant == 'all'  )
            Restaurant::where(['notificationStatut' => 2 , 'id_fournisseur' =>Auth::guard('fournisseur')->user()->id])->update(['notificationStatut'=> 3]);
        if(request()->restaurant != 'all' && request()->restaurant != '')
            Restaurant::where(['id' => request()->restaurant , 'id_fournisseur' =>Auth::guard('fournisseur')->user()->id ])->update(['notificationStatut'=> 3]);
        
       
        return Datatables::of($restaurants) ->addColumn('action', function ($restaurant) {
            return '
            <a href="'.url("fournisseur/get/restaurant").'/'.$restaurant->id.'" style="margin-top:5px   " class="btn btn-xs btn-info"><i class="glyphicon glyphicon-eye-open"></i> Voir</a>
            <button style="margin-top:5px   "  type="button" onclick=\'setInfo('.$restaurant.')\'   data-toggle="modal" data-target="#editRestaurant" class="btn btn-xs btn-info"><i class="glyphicon glyphicon-edit"></i> Edit</button>
            <a style="margin-top:5px   " href="'.url("fournisseur/supprimer/restaurant").'/'.$restaurant->id.'" class="btn btn-xs btn-danger"><i class="glyphicon glyphicon-trash"></i> Supprimer</a>
            ';
        })
        ->addColumn('image', function ($restaurant) {
            return '<img style="    width: 65px;" src="'.url("").'/'.$restaurant->logo.'" />';
        })
        ->addColumn('statut', function ($restaurant) {

            $message = '';
            if($restaurant->etat == 1 ) 
            {
                $message =   $message .'<button desabled style = "width:90% ; margin: 5px ; cursor: no-drop;"  class="btn btn-xs btn-success">Acceptée</button><br>';
            }
            else if ($restaurant->etat == 2)  {
                $message =   $message . '<button desabled style = "cursor: no-drop;width:90% ; margin: 5px"  class="btn btn-xs btn-danger">Refusée</button><br>';
            }
            else if ($restaurant->etat == 0)  {
                $message =   $message .'<button desabled style = "cursor: no-drop;width:90% ; margin: 5px" class="btn btn-xs btn-warning">en attente</button><br>';
            }

            return $message ; 
        })
        ->rawColumns(['image', 'action' , 'statut'])

        ->make(true);
    }


    public function ajout (Request $request) {
        $validator =  Validator::make($request->all(), [
            'nom' => 'required|min:2|max:50',
            'adresse' => 'required|min:2|max:255',
            'telephone' => 'required|min:2|max:12',
            'ville' => 'required|max:255',
            'image'=>'required|image|mimes:jpg,jpeg,png,gif|max:4000',
            'latAjout' => 'required|max:255',
            'lngAjout' => 'required|max:255',

        ]);
        if ($validator->fails()) {
            return back()->with('errorAjoutRestaurant','d')
                        ->withErrors($validator)
                        ->withInput();
        } 
        $img_name = time().'.'.$request->image->getClientOriginalExtension();
        $request->image->move(public_path('uploads/img/restaurant'),$img_name);

            $Restaurant = new Restaurant();
            $Restaurant->id_fournisseur = Auth::guard('fournisseur')->user()->id;
            $Restaurant->logo = 'uploads/img/restaurant/'.$img_name;
            $Restaurant->nom = $request->nom;
            $Restaurant->adresse = $request->adresse;
            $Restaurant->ville = $request->ville;
            $Restaurant->telephone = $request->telephone;
            $Restaurant->lat =  $request->latAjout;
            $Restaurant->lng =  $request->lngAjout;
            $Restaurant->save();

        return back()->with('success', 'Le Restaurant a bien été créé'  );

    }

    public function modifier (Request $request , $id) {
        $Restaurant =  Restaurant::find($id);
        $validator = Validator::make($request->all(), [
            'nomedit' => 'required|min:2|max:50',
            'adresseedit' => 'required|min:2|max:255',
            'telephoneedit' => 'required|min:2|max:12',
            'villeedit' => 'required|max:255',
            'imageedit'=>'image|mimes:jpg,jpeg,png,gif|max:4000',
            'latEdit' => 'max:255',
            'lngEdit' => 'max:255',
        ]);
        if ($validator->fails()) {
            return back()->with('errorModifierRestaurant','d')
                        ->withErrors($validator)
                        ->withInput();
        }

        if($request->imageedit != '' ){
            $img_name = time().'.'.$request->imageedit->getClientOriginalExtension();
             $request->imageedit->move(public_path('uploads/img/restaurant'),$img_name);
             $Restaurant->logo = 'uploads/img/restaurant/'.$img_name;

        }
            $Restaurant->nom = $request->nomedit;
            $Restaurant->adresse = $request->adresseedit;
            $Restaurant->telephone = $request->telephoneedit;
            $Restaurant->ville = $request->villeedit;
            if ( $request->latEdit != '' &&  $request->lngEdit !='') {
                $Restaurant->lat = $request->latEdit;
                $Restaurant->lng = $request->lngEdit;
            }
            $Restaurant->etat = 0 ;
            $Restaurant->notificationStatut = 0 ;
            $Restaurant->save();

        return back()->with('success', 'Le Restaurant a bien été modifié'  );

    }

    public function supprimer ($id) {
        $Restaurant = Restaurant::find($id);
        if (Auth::guard('fournisseur')->user()->id == $Restaurant->id_fournisseur)
          {
              $Restaurant->delete();
          return back()->with('success', 'Le Restaurant a bien été supprimé');
        }
          return back();
    }
}

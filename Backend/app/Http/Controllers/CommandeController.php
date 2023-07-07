<?php

namespace App\Http\Controllers;

use App\Commande;
use App\Http\Resources\commande\CommandeResource;
use App\Pack;
use App\Repas;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Restaurant;
use App\Coupon;
class CommandeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $req = [];
        $i=0;
        if (request()->getOnly != null) {
            $req[$i] = ['statut' , request()->getOnly ]   ;
            $i++;
        }
        $commande = User::find(Auth::user()->id)->commande()->where($req)->orderBy('created_at','DESC')->paginate(6);
        if ($commande != null) {
            return response()->json(['success' => ['commandes' =>CommandeResource::collection($commande) , 'meta'=>$commande ]], 200);
        } else {
            return response()->json(['error' => 'not_found'], 404);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    private function verifRepas($value)
    {
        foreach ($value as  $value) {
            $repas =  Repas::find($value);
            $pack =  Pack::find($value);
            if ($repas === null && $pack === null) {
                return response()->json(['error' => 'not_found' . $value], 404);
            } 
        }
        return 0;
    }

    public function getPrix ($values , $coupon , $distance) {
        $prix = 0 ; 
        foreach ($values as  $value) {
            $repas =  Repas::find($value);
            $pack =  Pack::find($value);
     
                $repack = $repas === null ? $pack : $repas;
                $prix += $repack->prix;
            
        }
        if($coupon != '') {
            $coupons = Coupon::find($coupon);
            $prix = $prix - $prix*($coupons->remise/100);
        }
        $prix += $distance*0.5;
        $prix += $prix*0.04;

        return $prix;
    }


    public function store(Request $request)
    {
        $validator = validator($request->only( 'arrivee', 'repas' , 'ville', 'lat' , 'lng','temps' , 'distance'), [
            'arrivee' => 'string|max:50',
            'ville' => 'string|max:50',
            'lat' => 'required|max:50',
            'lng' => 'required|max:50',
            'temps' => 'required',
            'distance' => 'required',
            'repas' => 'required|JSON'
        ]);
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 404);
        }
        if($request->repas == "null") {
            return response()->json(['error' => ['sélectionner des produits pour passer une commande']], 404);
        }
        $verif = $this->verifRepas(json_decode($request->repas));
        if (gettype($verif) == 'object') {
            return   $verif;
        }
        $prix = $this->getPrix(json_decode($request->repas)  ,  $request->coupon , $request->distance);
        $data = request()->only('arrivee', 'repas' , 'lat' , 'lng');


        $commande =   Commande::create([
            'adresse'           => $request->arrivee != '' ? $request->arrivee :Auth::user()->adresse,
            'ville'           => $request->ville != '' ? $request->ville :Auth::user()->ville,
            'prix'              => $request->prix,
            'lat'          => $request->lat ,
            'lng'           => $request->lng ,
            'id_user'           => Auth::user()->id,
            'temps'    => $request->temps,
            'distance' => $request->distance,
            'id_coupon'   => $request->coupon
        ]);
        foreach (json_decode($data['repas']) as $key => $value) {
            DB::insert('insert into item (id_repas, id_commande) values (?, ?)', [$value, $commande->id]);
        }

        return response()->json(['success' => ['cree_avec_success']], 200);
    }

    function verifExiste ($rest , $item) {
        foreach ($rest as $key => $value) {
            if ($value == $item )
                return false ; 
        }
        return true;
    }
    function getRestaurant ( ) {
        $restau = [] ; 
        $i = 0; 
        $repas = [];
        $pack = [];

        if(request()->repas != ''){
            $repasValue= explode(",", request()->repas);
            $repas = Repas::whereIn('id' ,$repasValue)->get() ; 
        }

        if(request()->pack != '')
        {
            $packValue= explode(",", request()->pack);
            $pack = Pack::whereIn('id' , $packValue)->get() ; 
        }
            foreach ($repas as $key => $value) {
                if ($this->verifExiste($restau,$value->restaurant->id)) {
                    $restau[$i]= $value->restaurant->id;
                    $i++;
                }
   
            }
            foreach ($pack as $key => $value) {
                if ($this->verifExiste($restau,$value->restaurant->id)) {
                    $restau[$i]= $value->restaurant->id;
                    $i++;
                }
            }
            
            $restaurant = Restaurant::whereIn('id',$restau)->get();
            $restau = [] ; 
            $i = 0; 
            return response()->json(['success' => $restaurant], 200);
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $commande = Commande::find($id);
        if ($commande != null) {
            if ($commande->id_user == Auth::user()->id) {
                return response()->json(['success' => new CommandeResource($commande)], 200);
            } else {
                return response()->json(['error' => 'Unauthorised'], 404);
            }
        } else {
            return response()->json(['error' => 'not_found'], 404);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = validator($request->only('status'), [
            'status' => 'required|Integer',
        ]);
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 404);
        }


        $commande = Commande::find($id);
        if ($commande != null) {
            $data = request()->only('status');
            if (Auth::user()->id == $commande->id_user && $data['status'] == 0 || $data['status'] == 4) {

                $commande->statut = $data['status'];
                $commande->save();
                return response()->json(['success' => ['modifier_avec_success']], 200);
            } else {
                return response()->json(['error' => 'Unauthorised'], 404);
            }
        } else {
            return response()->json(['error' => 'not_found'], 404);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $commande = Commande::find($id);
        if ($commande != null) {
            if (Auth::user()->id == $commande->id_user) {
                $commande->delete();
                return response()->json(['success' => ['supprimmer_avec_success']], 200);
            } else {
                return response()->json(['error' => 'Unauthorised'], 404);
            }
        } else {
            return response()->json(['error' => 'not_found'], 404);
        }
    }
}

<?php

namespace App\Http\Controllers;

use App\Http\Resources\Fournisseur\FournisseurResPackResource ;
use App\Pack;
use App\Repas;
use App\Restaurant;
use App\specialite;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PackController extends Controller
{
    
    public function index()
    {
        
       
        $result = FournisseurResPackResource::collection(User::find(Auth::user()->id)->restaurant);
        return response()->json(['success' => $result], 200);
    }




    public function show($id)
    {
        $repas = Pack::find($id);
        if ($repas != null) {
            $restaurant = Restaurant::find($repas->id_restaurant);
            if ( $restaurant != null && Auth::user()->id == $restaurant->id_user) {
                return response()->json(['success' => $repas], 200);
            } else {
                return response()->json(['error' => 'Unauthorised'], 401);
            }
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
    public function store(Request $request)
    {
        $validator = validator($request->only('id_specialite', 'id_restaurant',  'libelle', 'description', 'image', 'prix' , 'repas'), [
            'id_specialite' => 'required|Integer',
            'id_restaurant' => 'required|Integer',
            'libelle' => 'required|string|max:50',
            'description' => 'required|string|max:255',
            'image' => 'required|string|max:255',
            'prix' => 'required|string|max:12',
            'repas'=>'required|JSON'
        ]);
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 401);
        }
        $verif = $this->verifRepas(json_decode($request->repas));
       if (  gettype($verif) == 'object' ) {
         return   $verif ;
       }

        $restaurant = Restaurant::find($request->id_restaurant);
        $specialite = specialite::find($request->id_specialite);
        if ($restaurant != null && $specialite != null) {
            if (Auth::user()->id == $restaurant->id_user) {
                $data = request()->only('id_specialite', 'id_restaurant',  'libelle', 'description', 'image', 'prix','repas');


                
              $pack =   Pack::create([
                    'id_specialite' => $data['id_specialite'],
                    'id_restaurant' => $data['id_restaurant'],
                    'libelle'       => $data['libelle'],
                    'description'   => $data['description'],
                    'image'         => $data['image'],
                    'prix'          => $data['prix'],
                    'type'          => 2
               ]);
                foreach (json_decode($data['repas']) as $key => $value) {
                    DB::insert('insert into repas_pack (id_repas, id_pack) values (?, ?)', [$value, $pack->id]);
                }

                return response()->json(['success' => ['cree_avec_success']], 200);
            } else {
                return response()->json(['error' => 'Unauthorised'], 401);
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
    private function verifRepas ($value){
        foreach ($value as  $value) {
            $repas =  Repas::find($value);
            if ($repas === null){
                 return response()->json(['error' => 'not_found'.$value], 404);
             }else {
                 $restaurant = Restaurant::find($repas->id_restaurant)  ; 
 
                 if (Auth::user()->id != $restaurant->id_user){
                     return response()->json(['error' => 'Unauthorised'.$value], 401);
                 }
             }
 
         }
         return 0 ; 
    }
    private function ajoutRepasPack ($repas , $id){
        foreach ($repas as $value) {
            if (!(count(DB::select('select * from repas_pack where id_repas = ?  and  id_pack = ?', [$value , $id]))>0))
                DB::insert('insert into repas_pack (id_repas, id_pack) values (?, ?)', [$value, $id]);
        }
        $reps =DB::select('select * from repas_pack where   id_pack = ?', [ $id]) ;
        foreach ($reps as  $rep) {
            $verif = false ; 
            foreach ($repas as $value) {
                if ( $value == $rep->id_repas ){
                    $verif = true ; 
                }
            }

            if (!$verif){
                DB::table('repas_pack')->where('id', $rep->id)->delete();
            }
        }
    }

    public function update(Request $request, $id)
    {
        $validator = validator($request->only('id_specialite', 'id_restaurant',  'libelle', 'description', 'image', 'prix','repas'), [
            'id_specialite' => 'required|Integer',
            'id_restaurant' => 'required|Integer',
            'libelle' => 'required|string|max:50',
            'description' => 'required|string|max:255',
            'image' => 'string|max:255',
            'prix' => 'required|string|max:12',
            'repas'=>'required|JSON'
        ]);
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 401);
        }
        $verif = $this->verifRepas(json_decode($request->repas));
        if (  gettype($verif) == 'object' ) {
         return   $verif ;
       }

        $restaurant = Restaurant::find($request->id_restaurant);
        $pack = Pack::find($id);
        if ($restaurant != null && $pack != null) {
            $restaurant2 = Restaurant::find($pack->id_restaurant);
            if (Auth::user()->id == $restaurant->id_user &&  Auth::user()->id == $restaurant2->id_user) {
                $data = request()->only('id_specialite', 'id_restaurant',  'libelle', 'description', 'image', 'prix','repas');
              
              
              
                $this->ajoutRepasPack(json_decode($data['repas']),$id);
            

                $pack->id_specialite = $data['id_specialite'];
                $pack->id_restaurant = $data['id_restaurant'];
                $pack->libelle       = $data['libelle'];
                $pack->description  = $data['description'];
                $pack->image        = $data['image'];
                $pack->prix          = $data['prix'];
                $pack->save();


                return response()->json(['success' => ['modifier_avec_success']], 200);
            } else {
                return response()->json(['error' => 'Unauthorised'], 401);
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
        $pack = Pack::find($id);

        if ($pack != null) {
            $restaurant = Restaurant::find($pack->id_restaurant);
            if ($restaurant != null &&  Auth::user()->id == $restaurant->id_user) {

                DB::table('repas_pack')->where('id_pack', $id)->delete();
                $pack->delete();
                
                return response()->json(['success' => ['supprimmer_avec_success']], 200);
            } else {

                return response()->json(['error' => 'Unauthorised'], 401);
            }
        } else {

            return response()->json(['error' => 'not_found'], 404);
        }

    }
}

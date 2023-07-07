<?php

namespace App\Http\Controllers;

use App\Http\Resources\Fournisseur\FournisseurResRepasRecource;
use App\Repas;
use App\Restaurant;
use App\specialite;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FournisseurRepasController extends Controller
{
    public function index()
    {   
        $result = FournisseurResRepasRecource::collection(User::find(Auth::user()->id)->restaurant);
        return response()->json(['success' => $result], 200);
    }




    public function show($id)
    {
       
        $repas = Repas::find($id);
        if ( $repas != null) {
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
        $validator = validator($request->only('id_specialite', 'id_restaurant',  'libelle', 'description', 'image', 'prix'), [
            'id_specialite' => 'required|Integer',
            'id_restaurant' => 'required|Integer',
            'libelle' => 'required|string|max:50',
            'description' => 'required|string|max:255',
            'image' => 'required|string|max:255',
            'prix' => 'required|string|max:12',
        ]);
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 401);
        }
        $restaurant = Restaurant::find($request->id_restaurant);
        $specialite = specialite::find($request->id_specialite);
        if ($restaurant != null && $specialite != null) {
            if (Auth::user()->id == $restaurant->id_user) {
                $data = request()->only('id_specialite', 'id_restaurant',  'libelle', 'description', 'image', 'prix');

                Repas::create([
                    'id_specialite' => $data['id_specialite'],
                    'id_restaurant' => $data['id_restaurant'],
                    'libelle'       => $data['libelle'],
                    'description'   => $data['description'],
                    'image'         => $data['image'],
                    'prix'          => $data['prix'],
                ]);

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
    public function update(Request $request, $id)
    {
        $validator = validator($request->only('id_specialite', 'id_restaurant',  'libelle', 'description', 'image', 'prix'), [
            'id_specialite' => 'required|Integer',
            'id_restaurant' => 'required|Integer',
            'libelle' => 'required|string|max:50',
            'description' => 'required|string|max:255',
            'image' => 'string|max:255',
            'prix' => 'required|string|max:12',
        ]);
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 401);
        }
        $restaurant = Restaurant::find($request->id_restaurant);
        $repas = Repas::find($id);
        if ($restaurant != null && $repas != null) {
            $restaurant2 = Restaurant::find($repas->id_restaurant);
            if (Auth::user()->id == $restaurant->id_user &&  Auth::user()->id == $restaurant2->id_user) {
                $data = request()->only('id_specialite', 'id_restaurant',  'libelle', 'description', 'image', 'prix');

                $repas->id_specialite = $data['id_specialite'];
                $repas->id_restaurant = $data['id_restaurant'];
                $repas->libelle       = $data['libelle'];
                $repas->description  = $data['description'];
                $repas->image        = $data['image'];
                $repas->prix          = $data['prix'];
                $repas->save();
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
        $repas = Repas::find($id);

        if ($repas != null) {
            $restaurant = Restaurant::find($repas->id_restaurant);
            if ($restaurant != null &&  Auth::user()->id == $restaurant->id_user) {

                $repas->delete();
                return response()->json(['success' => ['supprimmer_avec_success']], 200);
            } else {

                return response()->json(['error' => 'Unauthorised'], 401);
            }
        } else {

            return response()->json(['error' => 'not_found'], 404);
        }
    }
}

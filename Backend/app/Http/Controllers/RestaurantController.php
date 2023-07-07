<?php

namespace App\Http\Controllers;

use App\Http\Resources\Restaurant\RestaurantCollection;
use App\Restaurant;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RestaurantController extends Controller
{

    public function index()
    {
        $result = RestaurantCollection::collection(User::find(Auth::user()->id)->restaurant);
        return response()->json(['success' => $result], 200);
    }




    public function show($id)
    {
       
        $restaurant = Restaurant::find($id);
        if ($restaurant != null) {

            if (Auth::user()->id == $restaurant->id_user) {
                return response()->json(['success' => $restaurant], 200);
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
        $validator = validator($request->only('nom', 'logo',  'telephone', 'adresse'), [
            'nom' => 'required|string|max:20',
            'logo' => 'required|string|max:20',
            'adresse' => 'required|string|max:255',
            'telephone' => 'required|string|max:12',
        ]);
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 401);
        }
        $data = request()->only('nom', 'logo',  'telephone', 'adresse');

        Restaurant::create([
            'nom'        => $data['nom'],
            'logo'       => $data['logo'],
            'adresse'    => $data['adresse'],
            'telephone'  => $data['telephone'],
            'id_user'    => Auth::user()->id,
        ]);
        return response()->json(['success' => ['restaurant_cree_avec_success']], 200);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Restaurant  $restaurant
     * @return \Illuminate\Http\Response
     */
    public function update($id ,Request $request )
    {
        $restaurant = Restaurant::find($id);
        if ($restaurant != null) {

            if (Auth::user()->id == $restaurant->id_user) {
                $validator = validator($request->only('nom', 'logo',  'telephone', 'adresse'), [
                    'nom' => 'required|string|max:20',
                    'logo' => 'string|max:20',
                    'adresse' => 'required|string|max:255',
                    'telephone' => 'required|string|max:12',
                ]);
                if ($validator->fails()) {
                    return response()->json(['error' => $validator->errors()], 401);
                }
                $data = request()->only('nom', 'logo',  'telephone', 'adresse');
                $restaurant->nom       = $data['nom'];
                $restaurant->logo      = $data['logo'];
                $restaurant->adresse   = $data['adresse'];
                $restaurant->telephone = $data['telephone'];
                $restaurant->save();
                return response()->json(['success' => ['restaurant_modifier_avec_success']], 200);
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
     * @param  \App\Restaurant  $restaurant
     * @return \Illuminate\Http\Response
     */
    public function destroy($restaurant)
    {
        $restaurant = Restaurant::find($restaurant);
        if ($restaurant != null) {

            if (Auth::user()->id == $restaurant->id_user) {
                $restaurant->delete();
                return response()->json(['success' => ['supprimmer_avec_success']], 200);
            } else {
                return response()->json(['error' => 'Unauthorised'], 401);
            }
        } else {
            return response()->json(['error' => 'not_found'], 404);
        }
    }
}

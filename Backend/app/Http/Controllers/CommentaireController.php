<?php

namespace App\Http\Controllers;

use App\Commentaire;
use Illuminate\Http\Request;
use Auth ; 
use Validator;

class CommentaireController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       
        $rate = Commentaire::whereIn('id_repas' ,  explode(',' ,request()->repas ))->where( [ 'id_user' => Auth::user()->id  ] )->get();
        return response()->json(['success' => $rate], 200);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = validator($request->all(), [
            'note' => 'required',
            'id_repas' => 'required',
        ]);
        if ($validator->fails()) {
         return response()->json(['error' => $validator->errors()], 404);
       }
       $rate = Commentaire::where( [ 'id_user' => Auth::user()->id , 'id_repas' => $request->id_repas ] )->get();
       
       if($rate->count()>0) {
            $rate[0]->note = $request->note; 
            $rate[0]->save();
            
       }else {
            $rate = new Commentaire();
            $rate->note = $request->note;
            $rate->id_user = Auth::user()->id;
            $rate->id_repas = $request->id_repas;
            $rate->save();

       }
       return response()->json(['success' => ['cree_avec_success']], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Commentaire  $commentaire
     * @return \Illuminate\Http\Response
     */
    public function show(Commentaire $commentaire)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Commentaire  $commentaire
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Commentaire $commentaire)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Commentaire  $commentaire
     * @return \Illuminate\Http\Response
     */
    public function destroy(Commentaire $commentaire)
    {
        //
    }
}

<?php

namespace App\Http\Controllers;

use App\Http\Resources\specialite\specialiteResourceGet;
use App\specialite;
use Illuminate\Http\Request;

class SpecialiteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $req = [  ];
        if(request()->libelle !=''){   
            $req [0] = ['libelle', 'Like', '%'.request()->libelle.'%'] ; 
        }
        $res = specialite::where($req)->get();
        $result = specialiteResourceGet::collection($res);
        return  $result;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\specialite  $specialite
     * @return \Illuminate\Http\Response
     */
    public function show(specialite $specialite)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\specialite  $specialite
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, specialite $specialite)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\specialite  $specialite
     * @return \Illuminate\Http\Response
     */
    public function destroy(specialite $specialite)
    {
        //
    }
}

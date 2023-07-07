<?php

namespace App\Http\Controllers\Visiteur;

use App\Http\Controllers\Controller;
use App\Http\Resources\Repas\PackResource;
use App\Http\Resources\Repas\RepasResource;
use App\Pack;
use App\Repas;
use App\Tags;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Request;
use phpDocumentor\Reflection\DocBlock\Tag;

class RepasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */





    public function listRepas()
    {
        $req = [];
        if (request()->libelle != '') {
            $req[0] = ['libelle', 'Like', '%' . request()->libelle . '%'];
            $tags = Tags::where('mot', 'Like', '%' . request()->libelle . '%')->get();
            if( $tags->count()==0 && strlen(request()->libelle)>3){
                $tags = new Tags();
                $tags->mot =  request()->libelle ; 
                $tags->number = 1;
                $tags->save();
            }else {
                $tags = Tags::where('mot', 'Like', '%' . request()->libelle . '%')->first();
                if($tags!='')
              {  $tags->number =  $tags->number + 1;
                $tags->save();}
            }
        }
        if (request()->prix != '') {
            $req[1] = ['prix', '<=', request()->prix];
        }
        if (request()->specialite != '') {
            $specialite = explode(',', request()->specialite);
            if (request()->orderBy != ''){
                $res = Repas::where($req)->whereIn('id_specialite', $specialite)->orderBy('prix',request()->orderBy)->paginate(6);
                $res1 = Repas::where($req)->whereIn('id_specialite', $specialite)->orderBy('prix',request()->orderBy)->get();
            }else{
                $res = Repas::where($req)->whereIn('id_specialite', $specialite)->paginate(6);
                $res1 = Repas::where($req)->whereIn('id_specialite', $specialite)->get();
            }
        } else {
            if (request()->orderBy != ''){
                $res = Repas::where($req)->orderBy('prix',request()->orderBy)->paginate(6);
                $res1 = Repas::where($req)->orderBy('prix',request()->orderBy)->get();
            }else{
                $res = Repas::where($req)->paginate(6);
                $res1 = Repas::where($req)->get();
            }
        }

        if(request()->withget == 'get') {
            return  RepasResource::collection($res1) ; 
        }else {
            return  RepasResource::collection($res) ;
          
        }
    }


    public function listPack()
    {
        $req = [];

        if (request()->libelle != '') {
            $req[0] = ['libelle', 'Like', '%' . request()->libelle . '%'];
        }
        if (request()->prix != '') {
            $req[1] = ['prix', '<=', request()->prix];
        }
        if (request()->specialite != '') {
            $specialite = explode(',', request()->specialite);
            $ids = [];
            $i=0;
            $res = Pack::where($req)->get();
            foreach ($res as $key => $value) {
                if($value->repas()->whereIn('id_specialite',$specialite)->get()->count() > 0) {
                  $ids[$i] = $value->id;
                }
                $i++;
            }
            if (request()->orderBy != ''){
                $res = Pack::where($req)->whereIn('id',$ids)->orderBy('prix',request()->orderBy)->paginate(6);
            }else{
                $res = Pack::where($req)->whereIn('id',$ids)->paginate(6);
            }
           
        } else {
            if (request()->orderBy != ''){
                $res = Pack::where($req)->orderBy('prix',request()->orderBy)->paginate(6);
            }else{
                $res = Pack::where($req)->paginate(6);
            }
            
        }


        return  PackResource::collection($res);
    }




    public function showRepas($repas)
    {
        $repas = Repas::where(['type' => 1, 'id' => $repas])->first();
        if ($repas == null) {
            return response([
                'error' => 'Repas_not_found'

            ], 404);
        }

        return  new RepasResource($repas);
    }



    public function showPack($pack)
    {
        $pack = Pack::where(['type' => 2, 'id' => $pack])->first();
        if ($pack == null) {
            return response([
                'error' => 'Pack_not_found'

            ], 404);
        }
        return  new PackResource($pack);
    }
}

<?php

namespace App\Http\Controllers\Visiteur;

use App\Http\Controllers\Controller;
use App\Http\Resources\Restaurant\RestaurantCollection;
use App\Http\Resources\Restaurant\RestaurantResource;
use App\Restaurant;
use Illuminate\Http\Request;

class RestaurantController extends Controller
{
    public function listRestaurant()
    {
        $req = [];
        if (request()->ville != '') {
            $req[1] = ['ville', 'Like', '%' . request()->ville . '%'];
        }
        if (request()->nom != '') {
            $req[0] = ['nom', 'Like', '%' . request()->nom . '%'];
        }
        $orderby = 'asc';
        if(request()->orderBy != ''){
            $orderby = request()->orderBy;
        }
        if (request()->specialite != '') {
            $specialite = explode(',', request()->specialite);
            $ids = [];
            $i=0;
            $res = Restaurant::where($req)->get();
            foreach ($res as $key => $value) {
                if($value->repas()->whereIn('id_specialite',$specialite)->get()->count() > 0) {
                  $ids[$i] = $value->id;
                }
                $i++;
            }
            $res = Restaurant::where($req)->whereIn('id',$ids)->paginate(6);
        } else {
            $res = Restaurant::where($req)->paginate(6);
        }
        
        return  RestaurantCollection::collection($res) ;  
    }


    public function showRestaurant( $restaurant)
    {  
         $restaurant = Restaurant::find($restaurant);
        if($restaurant == null){
            return response([
                'error'=>'Rrestaurant_not_found'
            
            ],404);
        } 
       
        return  new RestaurantResource($restaurant) ; 
    }

}

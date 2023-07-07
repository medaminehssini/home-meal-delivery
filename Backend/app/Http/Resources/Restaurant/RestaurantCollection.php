<?php

namespace App\Http\Resources\Restaurant;

use App\Http\Resources\Repas\RepasResourceGet;
use App\Http\Resources\specialite\SpecialiteResource;
use Illuminate\Http\Resources\Json\JsonResource;

class RestaurantCollection extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    function verif($res)
    {
        $array = [];
        foreach ($res as $key => $value) {
            $array[$key] = $value->specialite->libelle;
        }
        return (array_unique($array));
    }
    function getRate($repas, $pack)
    {
        $i = 0;
        $rate = 0;
        foreach ($repas as  $value) {
            $rate += $value->commntaire->count() > 0 ?  $value->commntaire->sum('note') / $value->commntaire->count() :0;
            $value->commntaire->count() > 0 ? $i++ : '';
        }
        foreach ($pack as  $value) {
            $rate += $value->commntaire->count() == 0 ? 0 : $value->commntaire->sum('note') / $value->commntaire->count();
            $value->commntaire->count() > 0 ? $i++ : '';
        }
        if ($i == 0) {
            return 0;
        } else {
            return $rate / $i;
        }
    }
    function getComment($repas, $pack)
    {
     
        $comment = 0;
        foreach ($repas as  $value) {
            $comment += $value->commntaire->count();
        }
        foreach ($pack as  $value) {
            $comment += $value->commntaire->count() ;
        }

            return $comment;
        
    }


    public function toArray($request)
    {

        return [
            'id' => $this->id,
            'nom' => $this->nom,
            'telephone' => $this->telephone,
            'logo' => $this->logo,
            'ville' => $this->ville,
            'adresse' => $this->adresse,
            'minPrix' => $this->repas->count() > 0 ? $this->repas->min('prix') : 0,
            'rate' => $this->getRate($this->repas, $this->pack),
            'commentaire' => $this->getComment($this->repas, $this->pack),
            'specialite' => $this->verif(SpecialiteResource::collection($this->repas)),
            'created_at' => $this->created_at,
        ];
    }
}

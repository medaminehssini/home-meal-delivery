<?php

namespace App\Http\Resources\Repas;

use App\Http\Resources\CommentaireResource;
use Illuminate\Http\Resources\Json\JsonResource;

class RepasResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id'=>$this->id,
            'libelle'=>$this->libelle,
            'description'=>$this->description,
            'image'=>$this->image,
            'prix'=>$this->prix, 
            'rate'=>$this->commntaire->count() ==0 ? 0 : $this->commntaire->sum('note')/$this->commntaire->count(),
            'nbrCommntaire'=>$this->commntaire->count(),
            'type'=>'repas', 
            'created_at'=>$this->created_at,
            'restaurant'=> [
                'id'=>$this->restaurant->id,
                'nom'=>$this->restaurant->nom,
                'telephone'=>$this->restaurant->telephone,
                'logo'=>$this->restaurant->logo,
                'adresse'=>$this->restaurant->adresse,
                'ville'=>$this->restaurant->ville,
                'lng'=>$this->restaurant->lng,
                'lat'=>$this->restaurant->lat,
            ],
            
            'specialite'=> [
                'libelle'=>$this->specialite->libelle,
            ],

        ];
        
        
        
    }
}

<?php

namespace App\Http\Resources\Fournisseur;

use Illuminate\Http\Resources\Json\JsonResource;

class FournisseurRepasRecource extends JsonResource
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
            'libelle' => $this->description,
            'description' => $this->description,
            'image' => $this->image,
            'prix'=>  $this->prix , 
            'repas'=>$this->repas,
            'restaurant'=>$this->restaurant->nom,
            'created_at' => $this->created_at,
        ];
    }
}

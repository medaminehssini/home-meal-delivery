<?php

namespace App\Http\Resources\specialite;

use Illuminate\Http\Resources\Json\JsonResource;

class SpecialiteResource extends JsonResource
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

        'id' => $this->specialite->id,
        'libelle' => $this->specialite->libelle,
          
        ];
    }
}

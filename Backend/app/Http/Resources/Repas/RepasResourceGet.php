<?php

namespace App\Http\Resources\Repas;

use Illuminate\Http\Resources\Json\JsonResource;

class RepasResourceGet extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request )
    {
        return [
            'id'=>$this->id,
            'libelle'=>$this->libelle,
            'description'=>$this->description,
            'image'=>$this->image,
            'prix'=>$this->prix,  
            'type'=>$this->type == 1 ?'Repas':'Pack', 
            'rate'=>$this->commntaire->count() ==0 ? 0 : $this->commntaire->sum('note')/$this->commntaire->count(),
            'specialite'=>[
                'id'=>$this->specialite->id,
                'libelle'=>$this->specialite->libelle,
            ],
            'created_at'=>$this->created_at,
        ];
    }
}

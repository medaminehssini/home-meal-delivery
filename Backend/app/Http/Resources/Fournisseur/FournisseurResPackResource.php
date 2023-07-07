<?php

namespace App\Http\Resources\Fournisseur;

use Illuminate\Http\Resources\Json\JsonResource;

class FournisseurResPackResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return  FournisseurRepasRecource::collection($this->pack);

    }
}

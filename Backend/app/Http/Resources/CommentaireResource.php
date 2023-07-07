<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CommentaireResource extends JsonResource
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
            'nom' => $this->user->nom,
            'image' => $this->user->image,
            'description' => $this->description,
            'note' => $this->note,
            'updated_at' => $this->updated_at,
            'created_at' => $this->created_at,
        ];
    }
}

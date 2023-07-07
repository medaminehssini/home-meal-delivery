<?php

namespace App\Http\Resources\commande;

use App\Http\Resources\Repas\RepasResourceGet;
use Illuminate\Http\Resources\Json\JsonResource;

class CommandeResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */


     public function verifStatus ($status){
        switch ($status) {
            case 1:
              return 'Accepté';
              break;
            case 2:
              return 'En cour de laivraison';
              break;
            case 3:
              return 'Livré';
              break;
            case 4:
              return 'Refusé';
              break;
            default:
              return 'En cour';
              break;
        }
     }
    public function toArray($request)
    {
        return [
            'id'=>$this->id,
            'date'=>$this->date_livraison,
            'prix'=>$this->prix ,
            'depart'=>$this->depart ,
            'arrivee'=>$this->adresse ,
            'status'=>$this->verifStatus($this->statut) ,
            'repas'=>RepasResourceGet::collection($this->repas) ,
            'pack'=>RepasResourceGet::collection($this->pack) ,
            'temps'=>$this->temps ,
            'distance'=>$this->distance ,
            'created_at'=>$this->created_at,
        ];
    }
}

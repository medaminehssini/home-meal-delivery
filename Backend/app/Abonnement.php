<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Abonnement extends Model
{
    protected $table = 'abonnement';
    public $timestamps  = false;

    public function service()
    {
        return $this->belongsToMany('App\OptionAbonnement' , 'service_abonnement', 'abonnement_id', 'service_id' );
    }
    public function abonnee()
    {
        return $this->hasMany('App\Abonnee','id_abonnement');
    }
    public function fournisseur()
    {
        return $this->belongsToMany('App\Fournisseur' , 'abonnee', 'id_abonnement', 'id_fournisseur' );
    }
}

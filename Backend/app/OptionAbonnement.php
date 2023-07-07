<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OptionAbonnement extends Model
{
    protected $table = 'service'; 
    public $timestamps  = false;



    public function abonnement()
    {
        return $this->belongsToMany('App\Abonnement', 'service_abonnement', 'service_id', 'abonnement_id');
    }
}

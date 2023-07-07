<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Transporteur extends Authenticatable
{
    protected $table = 'transporteur';
    protected $guard = 'transporteur';
    public function commande()
    {
        return $this->hasMany('App\Commande' , 'id_transporteur');
    } 
}

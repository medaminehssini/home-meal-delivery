<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    protected $table = 'coupon';
    public $timestamps = false;
    public function commande (){
        return $this->belongsTo('App\Commande' , 'id_coupon');
    }
    public function abonnee (){
        return $this->belongsTo('App\Abonnee' , 'id_coupon');
    }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Commande extends Model
{
    protected $table ='commande';



    protected $fillable = [
        'prix', 'date_livraison',  'depart', 'arrivee','id_user' , 'lat' , 'lng','ville' , 'id_coupon' ,'distance', 'temps' 
    ];

    public function user (){
        return $this->belongsTo('App\User' , 'id_user');
    }
    public function repas()
    {
        return $this->belongsToMany('App\Repas', 'item', 'id_commande', 'id_repas');
    }
    public function pack()
    {
        return $this->belongsToMany('App\Pack', 'item', 'id_commande', 'id_repas');
    }
    public function coupon()
    {
        return $this->belongsTo('App\Coupon', 'id_coupon');
    }
    public function item (){
        return $this->hasMany('App\Item','id_commande');
    }  

}

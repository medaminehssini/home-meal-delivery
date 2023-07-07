<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    protected $table = 'item';
    public function repas()
    {
        return $this->belongsTo('App\Repas', 'id_repas');
    }
    public function commande()
    {
        return $this->belongsTo('App\Commande', 'id_commande');
    }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Commentaire extends Model
{
    protected $table='commentaire';
    public function user()
    {
        return $this->belongsTo('App\User','id_user');
    }
    public function repas()
    {
        return $this->belongsTo('App\Repas','id_repas');
    }
}

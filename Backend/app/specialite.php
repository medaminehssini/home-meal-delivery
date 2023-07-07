<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class specialite extends Model
{
    protected $table ='specialite';



    public function Repas()
    {
        return $this->hasMany('App\Repas','id_specialite');
    } 
}

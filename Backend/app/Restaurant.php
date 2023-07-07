<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Restaurant extends Model
{
    protected $table ='restaurant';

    protected $fillable = [
        'nom', 'logo',  'telephone', 'adresse','id_fournisseur'
    ];

    public function fournisseur()
    {
        return $this->belongsTo('App\Fournisseur','id_fournisseur');
    }


    public function Repas()
    {
        return $this->hasMany('App\Repas','id_restaurant');
    } 

    public function pack()
    {
        return $this->hasMany('App\Pack','id_restaurant');
    } 
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Fournisseur extends Authenticatable
{
    protected $guard = 'fournisseur';
    protected $table = 'fournisseurs';
    public function abonnement()
    {
        return $this->belongsToMany('App\Abonnement' , 'abonnee', 'id_fournisseur', 'id_abonnement' );
    }
    public function abonnee()
    {
        return $this->hasMany('App\Abonnee','id_fournisseur');
    }
    public function restaurant()
    {
        return $this->hasMany('App\Restaurant','id_fournisseur');
    } 
    protected $fillable = [
        'email', 'nom', 'prenom', 'adresse', 'telephone', 'codePostale', 'ville', 'password'
    ];

}

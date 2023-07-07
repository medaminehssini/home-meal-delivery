<?php

namespace App;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Repas extends Model
{
    protected $table = 'repas';

    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope('type', function (Builder $builder) {
            $builder->where('type', '=', 1);
        });
    }

    protected $fillable = [
        'id_specialite', 'id_restaurant',  'libelle', 'description', 'image', 'prix'
    ];

    public function specialite()
    {
        return $this->belongsTo('App\specialite', 'id_specialite');
    }

    public function restaurant()
    {
        return $this->belongsTo('App\Restaurant', 'id_restaurant');
    }

    public function commntaire()
    {
        return $this->hasMany('App\Commentaire', 'id_repas');
    }
    public function pack()
    {
        return $this->belongsToMany('App\pack', 'repas_pack', 'id_repas', 'id_pack');
    }
    public function commande()
    {
        return $this->belongsToMany('App\Commande', 'item', 'id_repas', 'id_commande');
    }
}

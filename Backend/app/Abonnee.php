<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Abonnee extends Model
{
    protected $table = 'abonnee';

    public function abonnement()
    {
        return $this->belongsTo('App\Abonnement', 'id_abonnement');
    }
    public function fournisseur()
    {
        return $this->belongsTo('App\Fournisseur', 'id_fournisseur');
    }
    public function coupon()
    {
        return $this->belongsTo('App\Coupon', 'id_coupon');
    }
}

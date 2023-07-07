<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Restaurant;
use App\Commande;
use Auth;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer('layouts.navbar',function($view){
            if(Auth::guard('admin')->check())
              $res = Restaurant::where('notificationStatut' , 0)->limit(5)->get();
            if(Auth::guard('fournisseur')->check())
              $res = Restaurant::where([
                  'notificationStatut' => 2 ,
                   'id_fournisseur' => Auth::guard('fournisseur')->user()->id
                ])->limit(5)->get();
            if(Auth::guard('transporteur')->check())
                $res = Commande::where([
                    'statut' => 1  ,
                    'ville' => Auth::guard('transporteur')->user()->ville
                ])->limit(5)->get();
              $view->with('notification' , $res);
          });
    }
}

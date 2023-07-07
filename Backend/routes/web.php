<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/




Route::get('login/{provider}', 'AdminController@getLogin')->name('login');
Route::post('login/{provider}', 'AdminController@login');
Route::get('logout', 'AdminController@logout');




Route::group(['middleware' => [ 'auth:transporteur,admin,fournisseur'  ]], function() {
    Route::get('edit/profile', 'ProfileController@getprofile');
    Route::post('edit/profile', 'ProfileController@setprofile');
  });


Route::middleware(['auth:admin'])->group(function () {
    Route::get('/','AdminController@getDashboard');
        

    Route::get('/liste/admin', function () {
        return view('admin.adminlist');
    })->name('admin.list');

    


    //admin
    Route::post('ajout/admin', 'AdminController@ajout');
    Route::put('modifier/admin/{id}', 'AdminController@modifier');
    Route::get('supprimer/admin/{id}', 'AdminController@supprimer');
    Route::get('datatable/get/admin', 'AdminController@getDataTable');


    //client
    Route::get('liste/users', 'Admin\UserController@listUser')->name('admin.users');
    Route::post('ajout/client', 'Admin\UserController@ajout');
    Route::put('modifier/client/{id}', 'Admin\UserController@modifier');
    Route::get('supprimer/client/{id}', 'Admin\UserController@supprimer');
    Route::get('datatable/get/users', 'Admin\UserController@getDataTable');



    //Coupon
    Route::get('liste/coupons', 'Admin\CouponController@listCoupons')->name('admin.Coupon');
    Route::post('ajout/coupon', 'Admin\CouponController@ajout');
    Route::put('modifier/coupon/{id}', 'Admin\CouponController@modifier');
    Route::get('supprimer/coupon/{id}', 'Admin\CouponController@supprimer');
    Route::get('datatable/get/coupon', 'Admin\CouponController@getDataTable');

    //specialite
    Route::get('liste/specialite', 'Admin\specialiteController@listspecialite')->name('admin.specialite');
    Route::post('ajout/specialite', 'Admin\specialiteController@ajout');
    Route::put('modifier/specialite/{id}', 'Admin\specialiteController@modifier');
    Route::get('supprimer/specialite/{id}', 'Admin\specialiteController@supprimer');
    Route::get('datatable/get/specialite', 'Admin\specialiteController@getDataTable');

    //Fournisseur
        Route::get('liste/fournisseur', 'Admin\FournisseurController@listFournisseur')->name('admin.fournisseur');
        Route::post('ajout/fournisseur', 'Admin\FournisseurController@ajout');
        Route::put('modifier/fournisseur/{id}', 'Admin\FournisseurController@modifier');
        Route::get('supprimer/fournisseur/{id}', 'Admin\FournisseurController@supprimer');
        Route::get('datatable/get/fournisseurs', 'Admin\FournisseurController@getDataTable');


    //restaurant 
        Route::get('accepter/restaurant/{id}', 'Admin\RestaurantController@accepter');
        Route::put('refuser/restaurant/{id}', 'Admin\RestaurantController@refuser');
        Route::get('get/liste/restaurants/{id}', 'Admin\RestaurantController@getDataTable');

    //commande 
    Route::get('liste/commande', 'Admin\CommandeController@listCommande')->name('admin.fournisseur');
    Route::post('ajout/commande', 'Admin\CommandeController@ajout');
    Route::get('accepter/commande/{id}', 'Admin\CommandeController@accepter');
    Route::get('refuser/commande/{id}', 'Admin\CommandeController@refuser');
    Route::get('datatable/get/commande', 'Admin\CommandeController@getDataTable');
    Route::get('get/liste/item/{id}', 'Admin\CommandeController@getItemDataTable');

    //Service Abonnement 
    Route::get('liste/abonnement', 'Admin\AbonnementController@listAbonnement')->name('admin.abonnement');
    Route::post('ajout/abonnement', 'Admin\AbonnementController@ajout');
    Route::put('modifier/abonnement/{id}', 'Admin\AbonnementController@modifier');
    Route::get('supprimer/abonnement/{id}', 'Admin\AbonnementController@supprimer');
    Route::get('datatable/get/abonnement', 'Admin\AbonnementController@getDataTable');

    //Service Abonnement 
    Route::get('liste/abonnement/option', 'Admin\optionController@listOption')->name('admin.service');
    Route::post('ajout/abonnement/option', 'Admin\optionController@ajout');
    Route::put('modifier/abonnement/option/{id}', 'Admin\optionController@modifier');
    Route::get('supprimer/abonnement/option/{id}', 'Admin\optionController@supprimer');
    Route::get('datatable/get/abonnement/options', 'Admin\optionController@getDataTable');


    // Abonnee
    Route::get('liste/abonnee', 'Admin\AbonneeController@listAbonnee')->name('admin.abonnee');
    Route::post('ajout/abonnee', 'Admin\AbonneeController@ajout');
    Route::put('modifier/abonnee/{id}', 'Admin\AbonneeController@modifier');
    Route::get('supprimer/abonnee/{id}', 'Admin\AbonneeController@supprimer');
    Route::get('datatable/get/abonnee', 'Admin\AbonneeController@getDataTable');
    Route::get('refuser/abonnee/{id}', 'Admin\AbonneeController@refuserAbonnee');
    Route::get('accepter/abonnee/{id}', 'Admin\AbonneeController@AccepterAbonnee');
    //transporteur
    Route::get('liste/transporteur', 'Admin\TransporteurController@listTransporteur')->name('admin.fournisseur');
    Route::post('ajout/transporteur', 'Admin\TransporteurController@ajout');
    Route::put('modifier/transporteur/{id}', 'Admin\TransporteurController@modifier');
    Route::get('supprimer/transporteur/{id}', 'Admin\TransporteurController@supprimer');
    Route::get('datatable/get/transporteur', 'Admin\TransporteurController@getDataTable');
    Route::get('datatable/get/transporteur/commande/{id}', 'Admin\TransporteurController@getDataTableCommande');

}); 

Route::middleware(['auth:fournisseur'])->prefix('fournisseur')->group(function () {



    //client
        Route::get('liste/restaurant', 'Fournisseur\RestaurantController@listeRestaurants');
        Route::post('ajout/restaurant', 'Fournisseur\RestaurantController@ajout');
        Route::put('modifier/restaurant/{id}', 'Fournisseur\RestaurantController@modifier');
        Route::get('supprimer/restaurant/{id}', 'Fournisseur\RestaurantController@supprimer');
        Route::get('datatable/get/restaurant', 'Fournisseur\RestaurantController@getDataTable');
    //client
        Route::get('get/restaurant/{id}', 'Fournisseur\RepasPackController@listeRepasPack');
        Route::post('ajout/{type}/{id}', 'Fournisseur\RepasPackController@ajout');
        Route::put('modifier/{type}/{id}/{restaurant}', 'Fournisseur\RepasPackController@modifier');
        Route::get('supprimer/{type}/{id}', 'Fournisseur\RepasPackController@supprimer');
        Route::get('datatable/get/{type}/{id}', 'Fournisseur\RepasPackController@getDataTable');
    //commande
        Route::get('liste/commande', 'Fournisseur\CommandeController@index');
        Route::get('get/commande', 'Fournisseur\CommandeController@getDataTable');
        Route::get('get/item/commande/{id}', 'Fournisseur\CommandeController@getItemDataTable');
        Route::get('accepter/commande/{id}', 'Fournisseur\CommandeController@accepter');
        Route::get('refuser/commande/{id}', 'Fournisseur\CommandeController@refuser');

        
});

Route::middleware(['auth:transporteur'])->prefix('transporteur')->group(function () {


    //commande 
    Route::get('liste/commande', 'Transporteur\CommandeController@listCommande')->name('admin.fournisseur');
    Route::get('accepter/commande/{id}', 'Transporteur\CommandeController@accepter');
    Route::get('datatable/get/commande', 'Transporteur\CommandeController@getDataTable');
    Route::get('get/transporteur/liste/item/{id}', 'Admin\CommandeController@getItemDataTable');

    Route::get('liste/historique/commande', 'Transporteur\CommandeController@listCommandeHistorique')->name('admin.fournisseur');
    Route::get('annuler/commande/{id}', 'Transporteur\CommandeController@annuler');
    Route::get('livre/commande/{id}', 'Transporteur\CommandeController@livre');
    Route::get('datatable/get/historique/commande', 'Transporteur\CommandeController@getDataTableHistorique');
});

Route::get('/home', 'HomeController@index')->name('home');



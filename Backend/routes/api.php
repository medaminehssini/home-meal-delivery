<?php

use App\Http\Middleware\CheckFournisseur;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
//contact Route
Route::post('contact', 'ContactController@setContact');
//register Route
Route::post('register', 'RegisterController@register');


//Login route
Route::post('login', 'RegisterController@login');

//App route
Route::get('list/repas', 'Visiteur\RepasController@listRepas');
Route::get('list/pack', 'Visiteur\RepasController@listPack');

Route::get('repas/{repas}', 'Visiteur\RepasController@showRepas');
Route::get('pack/{pack}', 'Visiteur\RepasController@showPack');

Route::get('list/restaurant', 'Visiteur\RestaurantController@listRestaurant');
Route::get('restaurant/{restaurant}', 'Visiteur\RestaurantController@showRestaurant');

Route::get('list/specialite', 'SpecialiteController@index');

Route::get('list/tags', 'TagsController@show');

Route::get('commande/retaurant' ,'CommandeController@getRestaurant' );
Route::get('coupon/info' ,'CouponController@getInfo' );

//client + fournisseur
Route::middleware('auth:api')->group(function () {

    Route::post('details', 'UserController@UserDetails');
    Route::put('edit/profile', 'UserController@updateProfile');
    Route::post('edit/latLng', 'UserController@editGoogleMapsParam');
    
    //commande
    Route::apiResource('commande','CommandeController');

    //
    Route::post('note', 'CommentaireController@store');
    Route::get('get/note', 'CommentaireController@index');
   
});

//fournisseur
Route::middleware('auth:api',CheckFournisseur::class)->group(function () {

    //Restaurant
    Route::apiResource('fournisseur/restaurant', 'RestaurantController');

    //repas
    Route::apiResource('fournisseur/repas','FournisseurRepasController');

    //pack
    Route::apiResource('fournisseur/pack','PackController');


});


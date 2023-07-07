<?php

namespace App\Http\Controllers\Fournisseur;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Fournisseur;
use Validator;
use App\Repas;
use App\Pack;
use App\specialite;
use Auth;
use Hash ;
use App\Restaurant;
use Yajra\Datatables\Datatables;
class RepasPackController extends Controller
{
    public function listeRepasPack   ($id) {
        $specialite = specialite::get();
        $restaurant = Restaurant::find($id);

        if ($restaurant->id_fournisseur == Auth::guard('fournisseur')->user()->id)    
            return view('fournisseur.repasPack.repasPack')->with([
                'restaurant'   =>  $restaurant , 
                'specialite'  =>  $specialite
            ]);

        return redirect('fournisseur/liste/restaurant');
    }
    public function getDataTable ($provider , $id) {
        if ( $provider == 'repas' ) {
            $items = Restaurant::find($id)->repas()->with('specialite')->get();
        } else if ($provider == 'pack') {
            $items = Restaurant::find($id)->pack()->with('specialite' , 'repas')->get();
        }

       
        return Datatables::of($items) ->addColumn('action', function ($item) {
            if ($item->type == 1) {
                $provider = 'repas' ;
                $type ='Repas';
            }else { 
                $type ='Pack';
                $provider = 'pack' ;
            }
            return '
            <button style="margin-top:5px   "  type="button" onclick=\'setInfo'.$provider.'('.$item.')\'   data-toggle="modal" data-target="#edit'.$type.'" class="btn btn-xs btn-info"><i class="glyphicon glyphicon-edit"></i> Edit</button>
            <a style="margin-top:5px   " href="'.url("fournisseur/supprimer/").'/'.$provider.'/'.$item->id.'" class="btn btn-xs btn-danger"><i class="glyphicon glyphicon-trash"></i> Supprimer</a>
            ';
        })
        ->addColumn('image', function ($item) {
            return '<img style="    width: 65px;" src="'.url("").'/'.$item->image.'" />';
        })
        ->rawColumns(['statut', 'image', 'action'])
        ->make(true);
    }


    public function ajout (Request $request , $type , $id) {
        $validator =  Validator::make($request->all(), [
            'libelle' => 'required|min:2|max:50',
            'description' => 'required|min:2|max:255',
            'prix' => 'required|min:2|max:12',
            'specialite' => 'required|max:255',
            'image'=>'required|image|mimes:jpg,jpeg,png,gif|max:4000',
        ]);

        
        if ($validator->fails()) {
            return back()->with('errorAjout'.$type,'d')
                        ->withErrors($validator)
                        ->withInput();
        }
        $img_name = time().'.'.$request->image->getClientOriginalExtension();
        $request->image->move(public_path('uploads/img/'.$type),$img_name);
            if ($type== 'repas') {
                $Repas = new Repas();
            }else if ($type== 'pack')   {
      
                $validator =  Validator::make($request->all(), [
                    'repas' => 'required',

                ]);
                if ($validator->fails()) {
                    return back()->with('errorAjout'.$type,'d')
                                ->withErrors($validator)
                                ->withInput();
                }
                $Repas = new Pack();
                $Repas->type = 2 ;
               

            }
            
            $Repas->id_restaurant = $id;
            $Repas->image = 'uploads/img/'.$type.'/'.$img_name;
            $Repas->id_specialite = $request->specialite;
            $Repas->prix = $request->prix;
            $Repas->description = $request->description;
            $Repas->libelle = $request->libelle;
            $Repas->save();
            if ($type== 'pack') {
                $Repas->repas()->attach($request->repas);

            }
            return back()->with('success', 'Le '.$type.' a bien été créé'  );

    }

    public function modifier (Request $request , $type,  $id , $restaurant) {
        if($type== 'repas') {
            $Repas =  Repas::find($id);
        }else if ($type== 'pack')   {
            $Repas =  Pack::find($id);
         }
        $Restaurant =  Restaurant::find($restaurant);
      
          $validator = Validator::make($request->all(), [

            'libelledit' => 'required|min:2|max:50',
            'descriptionedit' => 'required|min:2|max:255',
            'prixedit' => 'required|min:2|max:12',
            'specialiteedit' => 'required|max:255',
            'imageedit'=>'image|mimes:jpg,jpeg,png,gif|max:4000',
        ]);

        if ($validator->fails()) {
            return back()->with('errorModifier'.$type,'d')
                        ->withErrors($validator)
                        ->withInput();
        }
        if($type== 'pack') {
            $validator =  Validator::make($request->all(), [
                'repas' => 'required',

            ]);
            if ($validator->fails()) {
                return back()->with('errorModifier'.$type,'d')
                            ->withErrors($validator)
                            ->withInput();
            }
        }
        if ( $Restaurant != '' && $Repas!= '' && $Restaurant->id_fournisseur == Auth::guard('fournisseur')->user()->id  && $Repas->id_restaurant ==  $Restaurant->id )
        {
            if($request->imageedit != '' ){
                $img_name = time().'.'.$request->imageedit->getClientOriginalExtension();
                $request->imageedit->move(public_path('uploads/img/'.$type),$img_name);
                $Repas->image = 'uploads/img/'.$type.'/'.$img_name;

            }
            $Repas->libelle = $request->libelledit;
            $Repas->description= $request->descriptionedit;
            $Repas->prix = $request->prixedit;
            $Repas->id_specialite = $request->specialiteedit;
            $Repas->save();
            if($type== 'pack') {
                $Repas->repas()->sync($request->repas);
            }


        return back()->with('success', 'Le '. $type.' a bien été modifié'  );
         }
        return redirect('');
    }

    public function supprimer ($provider, $id) {
     
        if ($provider == 'repas') {
            $Repas = Repas::find($id);
            if ($Repas != '' && Auth::guard('fournisseur')->user()->id ==$Repas->restaurant->id_fournisseur)
              {
                $Repas->delete();
                 return back()->with('success', 'Le Repas a bien été supprimé');
             }  
        }else 
        if ($provider == 'pack') {
            $pack = Pack::find($id);
            if ($pack != '' && Auth::guard('fournisseur')->user()->id ==$pack->restaurant->id_fournisseur)
              {
                $pack->repas()->detach();
                $pack->delete();
                 return back()->with('success', 'Le Pack a bien été supprimé');
             } 
        }

          return back();
    }
}

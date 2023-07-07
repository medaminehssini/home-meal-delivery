<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\specialite;
use Validator;
use Auth;
use Hash ;
use Yajra\Datatables\Datatables;
class specialiteController extends Controller
{

    public function listSpecialite () {
        return view('admin.specialite.liste');
    } 
    public function getDataTable () {
        $specialites = specialite::get();
        return Datatables::of($specialites) 
        ->addColumn('action', function ($specialite) {
            return '<button type="button" onclick=\'setInfo('.$specialite.')\'   data-toggle="modal" data-target="#editSpecialite" class="btn btn-xs btn-info"><i class="glyphicon glyphicon-edit"></i> Edit</button>
            <a href="'.url("/supprimer/specialite").'/'.$specialite->id.'" class="btn btn-xs btn-danger"><i class="glyphicon glyphicon-trash"></i> Supprimer</a>
            ';
        })
        ->addColumn('photo', function ($specialite) {
            return '<img style="width: 70px;" src="'.url('').'/'.$specialite->image.'"/>';
        })
        ->rawColumns(['photo', 'action'])
        ->make(true);
    }


    public function ajout (Request $request) {
        $validator =  Validator::make($request->all(), [
            'libelle' => 'required|min:2|max:50',
            'description' => 'required|min:3',
            'image' => 'required|image',
        ]);
        if ($validator->fails()) {
            return back()->with('errorSpecialite','d')
                        ->withErrors($validator)
                        ->withInput();
        }
        $img_name = time().'.'.$request->image->getClientOriginalExtension();
        $request->image->move(public_path('images/specialite'),$img_name);

            $specialite = new specialite();
            $specialite->libelle = $request->libelle;
            $specialite->description = $request->description;
            $specialite->image = 'images/specialite/'.$img_name;
            $specialite->save();

        return back()->with('success', 'Le Spécialité a bien été créé'  );

    }

    public function modifier (Request $request , $id) {
        
        $specialite =  specialite::find($id);
        $validator =  Validator::make($request->all(), [
            'libelleedit' => 'required|min:2|max:50',
            'descriptionedit' => 'required|min:3',
            'imageedit' => 'image',
        ]);
        if ($validator->fails()) {
            return back()->with('errorModifierSpecialite','d')
                        ->withErrors($validator)
                        ->withInput();
        }

        if($specialite != '') {

            if($request->imageedit != '' ){
              $img_name = time().'.'.$request->imageedit->getClientOriginalExtension();
              $request->imageedit->move(public_path('images/specialite/'),$img_name);
              $specialite->image = 'images/specialite/'.$img_name;
            }

            $specialite->libelle = $request->libelleedit;
            $specialite->description = $request->descriptionedit;
            $specialite->save();
            return back()->with('success', 'Le Spécialité a bien été modifié'  );
        }else {
            abort(404);
        }
    }

    public function supprimer ($id) {
        $specialite = specialite::find($id);
        if($specialite != '') {
            $specialite->delete();
            return back()->with('success', 'Le Spécialité a bien été supprimé');
        }else {
            abort(404);
        }
    }
}

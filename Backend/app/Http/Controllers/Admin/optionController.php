<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\OptionAbonnement as Option ;
use Validator;
use Auth;
use Hash ;
use Yajra\Datatables\Datatables;
class optionController extends Controller
{
    public function listOption () {
        return view('admin.fournisseur.option');
    }
    public function getDataTable () {
        $Options = Option::select(['id','nom' ,'created_at' ]);

        return Datatables::of($Options) ->addColumn('action', function ($Option) {
            return '<button  type="button" onclick=\'setInfo('.$Option.')\'   data-toggle="modal" data-target="#editOption" class="btn btn-xs btn-info"><i class="glyphicon glyphicon-edit"></i> Edit</button>
            <a href="'.url("/supprimer/abonnement/option").'/'.$Option->id.'" class="btn btn-xs btn-danger"><i class="glyphicon glyphicon-trash"></i> Supprimer</a>
            ';
        })
        ->make(true);
    }


    public function ajout (Request $request) {
        $validator =  Validator::make($request->all(), [
            'nom' => 'required|min:2|max:50',
        ]);
        if ($validator->fails()) {
            return back()->with('errorAjoutOption','d')
                        ->withErrors($validator)
                        ->withInput();
        }
            $Option = new Option();
            $Option->nom = $request->nom;
            $Option->save();

        return back()->with('success', 'Le Service a bien été créé'  );

    }

    public function modifier (Request $request , $id) {
        $Option =  Option::find($id);
        $validator = Validator::make($request->all(), [
            'nomedit' => 'required|min:2|max:50',
        ]);
        if ($validator->fails()) {
            return back()->with('errorModifierOption','d')
                        ->withErrors($validator)
                        ->withInput();
        }

            $Option->nom = $request->nomedit;
            $Option->save();

            return back()->with('success', 'Le Service a bien été modifié'  );

    }

    public function supprimer ($id) {
        $Option = Option::find($id);
        $Option->delete();
        return back()->with('success', 'Le Service a bien été supprimé');
    }
}

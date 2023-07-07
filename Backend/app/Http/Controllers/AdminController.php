<?php

namespace App\Http\Controllers;
use Validator;
use Illuminate\Http\Request;
use Auth;
use Hash ;
use App\Admin;

use Yajra\Datatables\Datatables;
class AdminController extends Controller
{

    public function getDashboard () {
        
        return view('welcome');
    }


    public function getLogin ($provider) {

        if(!Auth::guard('admin')->check() && !Auth::guard('fournisseur')->check()  && !Auth::guard('transporteur')->check() )
        {
            if($provider != 'fournisseur' &&  $provider != 'admin' &&  $provider != 'transporteur' ){
                return redirect('login/fournisseur');
            } else {
                return view('login');
            }
        }else {

            if (Auth::guard('admin')->check() ) {
                return redirect('/liste/admin');
            }

            return redirect('/edit/profile');
        }

    }

    public function login (Request $request ,$provider) {
        if($provider == 'admin') {
            if(Auth::guard('admin')->attempt(['email' => $request->email, 'password' => $request->password])) {
                return redirect('liste/admin')->with('success', 'bienvenue ' . Auth::guard('admin')->user()->nom . '  ' . Auth::guard('admin')->user()->prenom  );
            }else {
                return back()->with('error', 'Vérifier votre donnee!');
            }
        } 
        else if ($provider == 'fournisseur') {
            if(Auth::guard('fournisseur')->attempt(['email' => $request->email, 'password' => $request->password])) {
                return redirect('/edit/profile')->with('success', 'bienvenue ' . Auth::guard('fournisseur')->user()->nom . '  ' . Auth::guard('fournisseur')->user()->nom  );
            }else {
                return back()->with('error', 'Vérifier votre donnee!');
            } 
        }else if($provider == 'transporteur') {
            if(Auth::guard('transporteur')->attempt(['email' => $request->email, 'password' => $request->password])) {
                return redirect('/edit/profile')->with('success', 'bienvenue ' . Auth::guard('transporteur')->user()->nom . '  ' . Auth::guard('transporteur')->user()->nom  );
            }else {
                return back()->with('error', 'Vérifier votre donnee!');
            } 
        }
        else
        {
            return redirect('/');
        }

    }

    public function logout () {
        if(Auth::guard('admin')->check())  {
            Auth::guard('admin')->logout();
            return redirect('login/admin');
        }else if( Auth::guard('fournisseur')->check() ) {
            Auth::guard('fournisseur')->logout();
         
            return redirect('login/fournisseur');
        }else if( Auth::guard('transporteur')->check() ) {
            Auth::guard('transporteur')->logout();
         
            return redirect('login/transporteur');
        }else {
            return redirect('login/fournisseur');
        }
    }




    public function getDataTable () {
        $admins = Admin::select(['id','nom' ,'prenom' ,'email','created_at','updated_at']);

        return Datatables::of($admins) ->addColumn('action', function ($admin) {
            return '<button type="button" onclick=\'setInfo('.$admin.')\'   data-toggle="modal" data-target="#editAdmin" class="btn btn-xs btn-info"><i class="glyphicon glyphicon-edit"></i> Edit</button>
            <a href="'.url("/supprimer/admin").'/'.$admin->id.'" class="btn btn-xs btn-danger"><i class="glyphicon glyphicon-trash"></i> Supprimer</a>
            ';
        })
        ->make(true);
    }


    public function ajout (Request $request) {
        $validator =  Validator::make($request->all(), [
            'nom' => 'required|min:2|max:50',
            'prenom' => 'required|min:2|max:50',
            'email' => 'required|unique:admins|max:255',
            'mot_de_passe' => 'required|confirmed|min:6|max:50',
        ]);
        if ($validator->fails()) {
            return back()->with('errorAjouAdmin','d')
                        ->withErrors($validator)
                        ->withInput();
        }

            $admin = new Admin();
            $admin->nom = $request->nom;
            $admin->prenom = $request->prenom;
            $admin->email = $request->email;
            $admin->password = Hash::make($request->mot_de_passe) ;
            $admin->save();

        return back()->with('success', 'L\'admin a bien été créé'  );

    }

    public function modifier (Request $request , $id) {
        $admin =  Admin::find($id);
        $validator = Validator::make($request->all(), [
            'nomedit' => 'required|min:2|max:50',
            'prenomedit' => 'required|min:2|max:50',
            'emailedit' => 'required|max:255|unique:admins,email,'.$admin->id,
        ]);
        if ($validator->fails()) {
            return back()->with('errorModifierAdmin','d')
                        ->withErrors($validator)
                        ->withInput();
        }
            $admin->nom = $request->nomedit;
            $admin->prenom = $request->prenomedit;
            $admin->email = $request->emailedit;
            if($request->mot_de_passe != ''){
                $validator = Validator::make($request->all(), [
                    'mot_de_passe' => 'confirmed|min:6|max:50',
                ]);
                if ($validator->fails()) {
                    return back()->with('errorModifierAdmin','d')
                                ->withErrors($validator)
                                ->withInput();
                }
                $admin->password = Hash::make($request->mot_de_passe) ;
            }
        
            $admin->save();

        return back()->with('success', 'L\'admin a bien été modifié'  );

    }

    public function supprimer ($id) {
        $admin = Admin::find($id);
        $admin->delete();
        return back()->with('success', 'L\'admin a bien été supprimé');
    }
}

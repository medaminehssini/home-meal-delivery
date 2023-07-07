<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Coupon;
use Validator;
use Auth;
use Hash ;
use Yajra\Datatables\Datatables;
class CouponController extends Controller
{
    public function listCoupons () {
        return view('admin.coupon.listeCoupon');
    }
    public function getDataTable () {
        $Coupons = Coupon::get();
        return Datatables::of($Coupons) ->addColumn('action', function ($Coupon) {
            return '<button type="button" onclick=\'setInfo('.$Coupon.')\'   data-toggle="modal" data-target="#editCoupon" class="btn btn-xs btn-info"><i class="glyphicon glyphicon-edit"></i> Edit</button>
            <a href="'.url("/supprimer/coupon").'/'.$Coupon->id.'" class="btn btn-xs btn-danger"><i class="glyphicon glyphicon-trash"></i> Supprimer</a>
            ';
        })
        ->make(true);
    }


    public function ajout (Request $request) {
        $validator =  Validator::make($request->all(), [
            'code' => 'required|min:2|max:50',
            'remise' => 'required|max:3',
            'date_fin' => 'required',
        ]);
        if ($validator->fails()) {
            return back()->with('errorAjoutCoupon','d')
                        ->withErrors($validator)
                        ->withInput();
        }


            $Coupons = new Coupon();
            $Coupons->code = $request->code;
            $Coupons->remise = $request->remise;
            $Coupons->date_fin = $request->date_fin;
            $Coupons->save();

        return back()->with('success', 'Le Coupon a bien été créé'  );

    }

    public function modifier (Request $request , $id) {
        $Coupon =  Coupon::find($id);
        $validator =  Validator::make($request->all(), [
            'code' => 'required|min:2|max:50',
            'remise' => 'required|max:3',
            'date_fin' => 'required',
        ]);
        if ($validator->fails()) {
            return back()->with('errorModifierCoupon','d')
                        ->withErrors($validator)
                        ->withInput();
        }

    
            $Coupon->code = $request->code;
            $Coupon->remise = $request->remise;
            $Coupon->date_fin = $request->date_fin;

        
            $Coupon->save();

        return back()->with('success', 'Le Coupon a bien été modifié'  );

    }

    public function supprimer ($id) {
        $Coupon = Coupon::find($id);
        $Coupon->delete();
        return back()->with('success', 'Le Coupon a bien été supprimé');
    }
}

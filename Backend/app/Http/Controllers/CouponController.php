<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Coupon;
class CouponController extends Controller
{
    public function getInfo () {
        $code = request()->code;
        $coupon = Coupon::where('code' , $code)->first() ;
        if($coupon != '')
            return response()->json(['success' => $coupon], 200);
        else
            return response()->json(['error' => $coupon], 404);
    }
}

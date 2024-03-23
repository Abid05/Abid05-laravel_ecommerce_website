<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class CheckoutController extends Controller
{
    //__checkout page
    public function Checkout()
    {
        if (!Auth::check()) {     
             $notification=array('messege' => 'Login Your Account!', 'alert-type' => 'error');
             return redirect()->back()->with($notification);  
        }
        $content=Cart::content();
        return view('frontend.cart.checkout',compact('content'));

    }

    //__apply coupn__
    public function ApplyCoupon(Request $request)
    {

        $check=DB::table('coupons')->where('coupon_code',$request->coupon)->first();
        if ($check) {
            //__coupon exist
            if (date('Y-m-d', strtotime(date('Y-m-d'))) <= date('Y-m-d', strtotime($check->valid_date))) {
                 Session::put('coupon',[
                    'name'=>$check->coupon_code,
                    'discount'=>$check->coupon_amount,
                    'after_discount'=>Cart::subtotal()-$check->coupon_amount
                 ]);
                 $notification=array('messege' => 'Coupon Applied!', 'alert-type' => 'success');
                 return redirect()->back()->with($notification);
            }else{
               $notification=array('messege' => 'Expired Coupon Code!', 'alert-type' => 'error');
               return redirect()->back()->with($notification);
            }
        }else{
             $notification=array('messege' => 'Invalid Coupon Code! Try again.', 'alert-type' => 'error');
             return redirect()->back()->with($notification);
        }

    }

    //__remove coupon__
    public function RemoveCoupon()
    {
         Session::forget('coupon');
         $notification=array('messege' => 'Coupon removed!', 'alert-type' => 'success');
         return redirect()->back()->with($notification);
    }
}

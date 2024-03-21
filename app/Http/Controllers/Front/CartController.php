<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CartController extends Controller
{
    //add to cart method
    public function addToCartQV(Request $request){
        $product=Product::find($request->id);
        Cart::add([
            'id'=>$product->id,
            'name'=>$product->name,
            'qty'=>$request->qty,
            'price'=>$request->price,
            'weight'=>'1',
            'options'=>['size'=>$request->size , 'color'=> $request->color ,'thumbnail'=>$product->thumbnail]

        ]);
        return response()->json("product added on cart!");
    }

    //all cart
    public function allCart()
    {
        $data=array();
        $data['cart_qty'] = Cart::count();
        $data['cart_total'] = Cart::total();
        return response()->json($data);
    }

    public function MyCart()
    {
        $content=Cart::content();
        return view('frontend.cart.cart',compact('content'));
    }

    public function RemoveProduct($rowId)
    {
        Cart::remove($rowId);
        return response()->json('Success!');
    }

    public function UpdateQty($rowId,$qty)
    {
        Cart::update($rowId, ['qty' => $qty]);
        return response()->json('Successfully Updated!');
    }

    public function UpdateColor($rowId,$color)
    {
        $product=Cart::get($rowId);
        $thumbnail=$product->options->thumbnail;
        $size=$product->options->size;
        Cart::update($rowId, ['options'  => ['color' => $color , 'thumbnail'=>$thumbnail ,'size'=>$size]]);
        return response()->json('Successfully Updated!');
    }

    public function UpdateSize($rowId,$size)
    {
        $product=Cart::get($rowId);
        $thumbnail=$product->options->thumbnail;
        $color=$product->options->color;
        Cart::update($rowId, ['options'  => ['size' => $size , 'thumbnail'=>$thumbnail ,'color'=>$color]]);
        return response()->json('Successfully Updated!');
    }

    public function EmptyCart()
    {
        Cart::destroy();
        $notification=array('messege' => 'Cart item clear', 'alert-type' => 'success');
        return redirect()->to('/')->with($notification); 
    }

    //wishlist
    public function addWishlist($id)
    {
        if (Auth::check()) {
            $userId = Auth::id();
            $check = DB::table('wishlists')->where('product_id', $id)->where('user_id', $userId)->first();
            if ($check) {
                $notification = array('messege' => 'Already have it on your wishlist!', 'alert-type' => 'error');
                return redirect()->back()->with($notification);
            } else {
                $data = array();
                $data['product_id'] = $id;
                $data['user_id'] = $userId;
                DB::table('wishlists')->insert($data);
                $notification = array('messege' => 'Product added to wishlist!', 'alert-type' => 'success');
                return redirect()->back()->with($notification);
            }
        }

            $notification = array('messege' => 'Login to your account!', 'alert-type' => 'error');
            return redirect()->back()->with($notification);
        
    }
}

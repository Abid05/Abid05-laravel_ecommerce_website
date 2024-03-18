<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;

class CartController extends Controller
{
    //add to cart method
    public function AddToCartQV(Request $request){
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
}

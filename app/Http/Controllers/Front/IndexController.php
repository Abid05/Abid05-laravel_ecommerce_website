<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\Review;
use App\Models\Subcategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class IndexController extends Controller
{   
    //root page
    public function index(){
        
        $category = Category::all();
        $brand = DB::table('brands')->inRandomOrder()->limit(12)->get();
        $bannerproduct = Product::where('status',1)->where('product_slider',1)->latest()->first();
        $featured = Product::where('status', 1)->where('featured', 1)->orderBy('id', 'DESC')->limit(16)->get();
        $today_deal = Product::where('status', 1)->where('today_deal', 1)->orderBy('id', 'DESC')->limit(6)->get();
        $popular_product = Product::where('status',1)->orderBy('product_views','DESC')->limit(16)->get();
        $trendy_product = Product::where('status',1)->where('trendy',1)->orderBy('id','DESC')->limit(8)->get();
        $random_product = Product::where('status',1)->inRandomOrder()->limit(8)->get();
        //homepage_category
        $home_category = DB::table('categories')->where('home_page',1)->orderBy('category_name','ASC')->get();
        return view('frontend.index',compact('category','bannerproduct','featured','popular_product','trendy_product','home_category','brand','random_product','today_deal'));
    }

    //single product page calling method
    public function productDetails($slug){
        $product = Product::where('slug',$slug)->first();
        $product_views = Product::where('slug',$slug)->increment('product_views');
        $related_product=DB::table('products')->where('subcategory_id',$product->subcategory_id)->orderBy('id','DESC')->take(10)->get();
        $review=Review::where('product_id',$product->id)->orderBy('id','DESC')->take(6)->get();
        return view('frontend.product.product_details',compact('product','related_product','review'));
    }

    //product quick viewsudo chmod -R ug+rwx storage bootstrap/cache

    public function productQuickView($id){

        $product = Product::where('id',$id)->first();
        
        return view('frontend.product.quick_view',compact('product'));
    }
}
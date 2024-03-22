<?php

use App\Http\Controllers\Controller;
use App\Http\Controllers\Front\CartController;
use App\Http\Controllers\Front\IndexController;
use App\Http\Controllers\Front\ReviewController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;


Auth::routes();


Route::get('/login',function(){
    return redirect()->to('/');
})->name('login');

Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('/customer/logout', [HomeController::class, 'logout'])->name('customer.logout');

//Frontend routes

Route::get('/',[IndexController::class,'index']);
Route::get('/product-details/{slug}',[IndexController::class,'productDetails'])->name('product.details');
Route::get('/product-quick-view/{id}',[IndexController::class,'productQuickView']);

//cart
Route::get('/all-cart',[CartController::class,'allCart'])->name('all.cart');//ajax req for subtotal
Route::get('/my-cart',[CartController::class,'MyCart'])->name('cart');
Route::get('/cart/empty',[CartController::class,'EmptyCart'])->name('cart.empty');
// Route::get('/checkout',[CartController::class,'Checkout'])->name('checkout');
// Route::post('/apply/coupon',[CartController::class,'ApplyCoupon'])->name('apply.coupon');
// Route::get('/remove/coupon',[CartController::class,'RemoveCoupon'])->name('coupon.remove');
// Route::post('/order/place',[CartController::class,'OrderPlace'])->name('order.place');


Route::post('/addtocart',[CartController::class,'addToCartQV'])->name('add.to.cart.quickview');
Route::get('/cartproduct/remove/{rowId}',[CartController::class,'RemoveProduct']);
Route::get('/cartproduct/updateqty/{rowId}/{qty}',[CartController::class,'UpdateQty']);
Route::get('/cartproduct/updatecolor/{rowId}/{color}',[CartController::class,'UpdateColor']);
Route::get('/cartproduct/updatesize/{rowId}/{size}',[CartController::class,'UpdateSize']);

//review for product
Route::post('/store/review',[ReviewController::class,'store'])->name('store.review');


//wishlist
Route::get('/wishlist',[CartController::class,'wishlist'])->name('wishlist');
Route::get('/clear/wishlist',[CartController::class,'Clearwishlist'])->name('clear.wishlist');
Route::get('/add/wishlist/{id}',[CartController::class,'addWishlist'])->name('add.wishlist');
Route::get('/wishlist/product/delete/{id}',[CartController::class,'WishlistProductdelete'])->name('wishlistproduct.delete');

//categorywise product
Route::get('/category/product/{id}',[IndexController::class,'categoryWiseProduct'])->name('categorywise.product');
Route::get('/subcategory/product/{id}',[IndexController::class,'SubcategoryWiseProduct'])->name('subcategorywise.product');
Route::get('/childcategory/product/{id}',[IndexController::class,'ChildcategoryWiseProduct'])->name('childcategorywise.product');
Route::get('/brandwise/product/{id}',[IndexController::class,'BrandWiseProduct'])->name('brandwise.product');

  

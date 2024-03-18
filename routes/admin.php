<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\CampaignController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ChildCategoryController;
use App\Http\Controllers\Admin\CouponController;
use App\Http\Controllers\Admin\PageController;
use App\Http\Controllers\Admin\PickupController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\SubcategoryController;
use App\Http\Controllers\Admin\WarehouseController;
use App\Http\Controllers\Auth\LoginController;

use Illuminate\Support\Facades\Route;



Route::get('/admin-login', [LoginController::class, 'adminLogin'])->name('admin.login');

Route::get('/log',function(){
    return view('abid');
});


Route::group(['middleware' => 'is_admin'],function(){ 

    Route::get('/admin/home',[AdminController::class,'admin'])->name('admin.home');
    Route::get('/admin/logout',[AdminController::class,'logout'])->name('admin.logout');
    Route::get('/admin/password/change',[AdminController::class,'passwordChnage'])->name('admin.password.change');
    Route::post('/admin/password/Update',[AdminController::class,'passwordUpdate'])->name('admin.password.update');

    //category route
    Route::group(['prefix'=>'category'],function(){

        Route::get('/',[CategoryController::class,'index'])->name('category.index');
        Route::post('/store',[CategoryController::class,'store'])->name('category.store');
        Route::get('/delete/{id}',[CategoryController::class,'delete'])->name('category.delete');
        Route::get('/edit/{id}',[CategoryController::class,'edit']);
        Route::post('/update',[CategoryController::class,'update'])->name('category.update');
    });

    //Subcategory route
    Route::group(['prefix'=>'subcategory'],function(){

        Route::get('/',[SubcategoryController::class,'index'])->name('subcategory.index');
        Route::post('/store',[SubcategoryController::class,'store'])->name('subcategory.store');
        Route::get('/delete/{id}',[SubcategoryController::class,'delete'])->name('subcategory.delete');
        Route::get('/edit/{id}',[SubcategoryController::class,'edit']);
        Route::post('/update',[SubcategoryController::class,'update'])->name('subcategory.update');
    });

    //Childcategory route
    Route::group(['prefix'=>'childcategory'],function(){

        Route::get('/',[ChildCategoryController::class,'index'])->name('childcategory.index');
        Route::post('/store',[ChildCategoryController::class,'store'])->name('childcategory.store');
        Route::get('/delete/{id}',[ChildcategoryController::class,'delete'])->name('childcategory.delete');
        Route::get('/edit/{id}',[ChildcategoryController::class,'edit']);
        Route::post('/update',[ChildcategoryController::class,'update'])->name('childcategory.update');
    });

    //Global route

        Route::get('/get-child-category/{id}',[CategoryController::class,'GetChildCategory']);

    //Brand route
    Route::group(['prefix'=>'brand'],function(){

        Route::get('/',[BrandController::class,'index'])->name('brand.index');
        Route::post('/store',[BrandController::class,'store'])->name('brand.store');
        Route::get('/delete/{id}',[BrandController::class,'destroy'])->name('brand.destroy');
        Route::get('/edit/{id}',[BrandController::class,'edit']);
        Route::post('/update',[BrandController::class,'update'])->name('brand.update');
    });

    //Product route
    Route::group(['prefix'=>'product'],function(){

        Route::get('/',[ProductController::class,'index'])->name('product.index');
        Route::get('/create',[ProductController::class,'create'])->name('product.create');
        Route::get('/delete/{id}',[ProductController::class,'destroy'])->name('product.delete');
        Route::post('/store',[ProductController::class,'store'])->name('product.store');
        Route::get('/edit/{id}',[ProductController::class,'edit'])->name('product.edit');
        Route::post('/update',[ProductController::class,'update'])->name('product.update');
        Route::get('/active-featured/{id}',[ProductController::class,'activefeatured']);
        Route::get('/not-featured/{id}',[ProductController::class,'notfeatured']);
        Route::get('/active-deal/{id}',[ProductController::class,'activedeal']);
        Route::get('/not-deal/{id}',[ProductController::class,'notdeal']);
        Route::get('/active-status/{id}',[ProductController::class,'activestatus']);
        Route::get('/not-status/{id}',[ProductController::class,'notstatus']);

    });

    //Coupon route
    Route::group(['prefix'=>'coupon'],function(){

        Route::get('/',[CouponController::class,'index'])->name('coupon.index');
        Route::post('/store',[CouponController::class,'store'])->name('coupon.store');
        Route::delete('/delete/{id}',[CouponController::class,'delete'])->name('coupon.destroy');
        Route::get('/edit/{id}',[CouponController::class,'edit']);
        Route::post('/update',[CouponController::class,'update'])->name('coupon.update');
    });

    //Campaign route
    Route::group(['prefix'=>'campaign'],function(){

        Route::get('/',[CampaignController::class,'index'])->name('campaign.index');
        Route::post('/store',[CampaignController::class,'store'])->name('campaign.store');
        Route::get('/delete/{id}',[CampaignController::class,'destroy'])->name('campaign.destroy');
        Route::get('/edit/{id}',[CampaignController::class,'edit']);
        Route::post('/update',[CampaignController::class,'update'])->name('campaign.update');
    });

    //warehouse route
    Route::group(['prefix'=>'warehouse'],function(){

        Route::get('/',[WarehouseController::class,'index'])->name('warehouse.index');
        Route::post('/store',[WarehouseController::class,'store'])->name('warehouse.store');
        Route::get('/delete/{id}',[WarehouseController::class,'delete'])->name('warehouse.delete');
        Route::get('/edit/{id}',[WarehouseController::class,'edit']);
        Route::post('/update',[WarehouseController::class,'update'])->name('warehouse.update');
    });

    //settings route
    Route::group(['prefix'=>'setting'],function(){
        //seo setting
        Route::group(['prefix'=>'seo'],function(){

            Route::get('/',[SettingController::class,'seo'])->name('seo.setting');
            Route::post('/update/{id}',[SettingController::class,'seoUpdate'])->name('seo.setting.update');
        });
        //smtp setting
        Route::group(['prefix'=>'smtp'],function(){

            Route::get('/',[SettingController::class,'smtp'])->name('smtp.setting');
            Route::post('/update/{id}',[SettingController::class,'smtpUpdate'])->name('smtp.setting.update');
        });
        //website setting
        Route::group(['prefix'=>'website'],function(){

            Route::get('/',[SettingController::class,'website'])->name('website.setting');
            Route::post('/update/{id}',[SettingController::class,'websiteUpdate'])->name('website.setting.update');
        });
        //page setting
        Route::group(['prefix'=>'page'],function(){

            Route::get('/',[PageController::class,'index'])->name('page.index');
            Route::get('/create',[PageController::class,'create'])->name('create.page');
            Route::post('/store',[PageController::class,'store'])->name('page.store');
            Route::get('/delete/{id}',[PageController::class,'destroy'])->name('page.delete');
            Route::get('/edit/{id}',[PageController::class,'edit'])->name('page.edit');
            Route::post('/update/{id}',[PageController::class,'update'])->name('page.update');
        });
        //pickup setting
        Route::group(['prefix'=>'pickup'],function(){

            Route::get('/',[PickupController::class,'index'])->name('pickuppoint.index');
            Route::post('/store',[PickupController::class,'store'])->name('pickuppoint.store');
            Route::delete('/delete/{id}',[PickupController::class,'destroy'])->name('pickuppoint.delete');
            Route::get('/edit/{id}',[PickupController::class,'edit']);
            Route::post('/update/{id}',[PickupController::class,'update'])->name('pickuppoint.update');
        });
        
    });
});
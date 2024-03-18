<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Subcategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class SubcategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    //index method for showing data
    public function index(){

        $data = DB::table('subcategories')->leftJoin('categories','subcategories.category_id','categories.id')
                ->select('subcategories.*','categories.category_name')->get();

        $category = Category::all();

        return view('admin.category.subcategory.index',compact('data','category'));   
    }

    //store method
    public function store(Request $request){
        $validated = $request->validate([
            'subcategory_name' => 'required|max:55',
        ]);

       Subcategory::insert([
            'category_id'=>$request->category_id,
            'subcategory_name'=>$request->subcategory_name,
            'subcategory_slug'=>Str::slug($request->subcategory_name,'-')
       ]);
       $notifiaction =['messege'=>'Subcategory Inserted!','alert-type'=>'success'];
        return redirect()->back()->with($notifiaction);

    }

    //delete method
    public function delete($id){
        $category = Subcategory::find($id);
        $category->delete(); 
        
        $notifiaction =['messege'=>'Subcategory Deleted!','alert-type'=>'success'];
        return redirect()->back()->with($notifiaction);
    }

    //Edit method
    public function edit($id){

        $data =Subcategory::find($id);
        $category = Category::all();

        return view('admin.category.subcategory.edit',compact('data','category')); 
        
    }

    //Update method
    public function update(Request $request){
        $id = $request->id;
       $subcat =  Subcategory::where('id', '=', $id)->update([
        'category_id'=>$request->category_id,
        'subcategory_name'=>$request->subcategory_name,
        'subcategory_slug'=>Str::slug($request->subcategory_name,'-')
       
    ]);

        $notifiaction =['messege'=>'Subcategory Updated!','alert-type'=>'success'];
        return redirect()->back()->with($notifiaction);
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Childcategory;
use App\Models\Subcategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Yajra\DataTables\Facades\DataTables;

class ChildCategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    //index method for showing data
    public function index(Request $request){

        if($request->ajax()){
            $data = DB::table('childcategories')->leftJoin('categories','childcategories.category_id','categories.id')->leftJoin('subcategories','childcategories.subcategory_id','subcategories.id')
            ->select('childcategories.*','categories.category_name','subcategories.subcategory_name')->get();

            return DataTables::of($data)

            ->addIndexColumn()
            ->addColumn('action',function($row){

             $action = '<a  data-id="'. $row->id.'" class="edit btn btn-info btn-sm" data-toggle="modal" data-target="#editModal"><i class="fas fa-edit"></i></a>

                        <a href="'.route('childcategory.delete',$row->id).'" class="btn btn-danger btn-sm" id="delete"><i class="fas fa-trash"></i></a>';

                return $action;

            })->rawColumns(['action'])->make(true);
        }
        $category = Category::all();

        return view('admin.category.childcategory.index',compact('category'));
    }

    //store method
    public function store(Request $request){
        

        $subCategory =Subcategory::where('id','=',$request->subcategory_id)->first();

       Childcategory::insert([
            'category_id'=>$subCategory->category_id,
            'subcategory_id'=>$request->subcategory_id,
            'childcategory_name'=>$request->childcategory_name,
            'childcategory_slug'=>Str::slug($request->childcategory_name,'-')
       ]);
       $notifiaction =['messege'=>'ChildCategory Inserted!','alert-type'=>'success'];
        return redirect()->back()->with($notifiaction);

    }

    //delete method
    public function delete($id){
        $category = Childcategory::find($id);
        $category->delete(); 
        
        $notifiaction =['messege'=>'Childcategory Deleted!','alert-type'=>'success'];
        return redirect()->back()->with($notifiaction);
    }

    //Edit method
    public function edit($id){

        // $data =Childcategory::find($id);
        $data = DB::table('childcategories')->where('id','=',$id)->first();
        // $category = Category::all();
        $category = DB::table('categories')->get();
        return view('admin.category.childcategory.edit',compact('data','category')); 
        
    }

    //Update method
    public function update(Request $request){

       $id = $request->id;
       $subCategory =Subcategory::where('id','=',$request->subcategory_id)->first();

       Childcategory::where('id', '=', $id)->update([
            'category_id'=>$subCategory->category_id,
            'subcategory_id'=>$request->subcategory_id,
            'childcategory_name'=>$request->childcategory_name,
            'childcategory_slug'=>Str::slug($request->childcategory_name,'-')
       ]);

        $notifiaction =['messege'=>'Childcategory Updated!','alert-type'=>'success'];
        return redirect()->back()->with($notifiaction);
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class CategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    //index method for showing data
    public function index(){

        $data =  Category::all();
        return view('admin.category.category.index',compact('data'));
    }
    
    //store method
    public function store(Request $request){
        $validated = $request->validate([
            'category_name' => 'required|unique:categories|max:55',
            'icon' => 'required',
        ]);
        $slug = Str::slug($request->category_name,'-');
        $photo=$request->icon;
        $photoName=$slug.'.'.$photo->getClientOriginalExtension();
        Image::make($photo)->resize(32,32)->save('files/category/'.$photoName);

       Category::insert([
            'category_name'=>$request->category_name,
            'category_slug'=> $slug,
            'home_page' => $request->home_page,
            'icon' => 'files/category/'.$photoName,
       ]);
       $notifiaction =['messege'=>'Category Inserted!','alert-type'=>'success'];
        return redirect()->back()->with($notifiaction);

    }

    //delete method
    public function delete($id){
        $category = Category::find($id);
        $category->delete(); 
        
        $notifiaction =['messege'=>'Category Deleted!','alert-type'=>'success'];
        return redirect()->back()->with($notifiaction);
    }

    //Edit method
    public function edit($id){
        $data =Category::find($id);
        return view('admin.category.category.edit',compact('data'));
        
    }

    //Update method
    public function update(Request $request){
        $id = $request->id;
        Category::where('id', '=', $id)->update([
        'category_name'=>$request->category_name,
        'category_slug'=>Str::slug($request->category_name,'-')
       
    ]);

    $slug =Str::slug($request->category_name,'-');
        $data = [];
        $data['category_name']=$request->category_name;
        $data['category_slug']=$request->$slug;
        $data['home_page']=$request->home_page;

        if($request->icon){

            if(File::exists($request->old_icon)){
                unlink($request->old_icon); 
            }
            $photo=$request->icon;
            $photoName=$slug.'.'.$photo->getClientOriginalExtension();
            Image::make($photo)->resize(32,32)->save('files/category/'.$photoName);
            $data['icon']='files/category/'.$photoName;
            DB::table('categories')->where('id','=',$request->id)->update($data);

            $notifiaction =['messege'=>'Category Updated!','alert-type'=>'success'];
            return redirect()->back()->with($notifiaction);

        }else{

            $data['brand_logo']= $request->old_icon;
            DB::table('categories')->where('id','=',$request->id)->update($data);
            $notifiaction =['messege'=>'Category Updated!','alert-type'=>'success'];
            return redirect()->back()->with($notifiaction);
        }
    }

    //get child category
    public function GetChildCategory($id)  //subcategory_id
    {
        $data=DB::table('childcategories')->where('subcategory_id','=',$id)->get();
        return response()->json($data);
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Brand;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Yajra\DataTables\Facades\DataTables;
use Intervention\Image\Facades\Image;


class BrandController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    //index method for showing data
    public function index(Request $request){

        if($request->ajax()){
            $data = DB::table('brands')->get();

            return DataTables::of($data)

            ->addIndexColumn()
            ->addColumn('action',function($row){

             $action = '<a  data-id="'. $row->id.'" class="edit btn btn-info btn-sm" data-toggle="modal" data-target="#editModal"><i class="fas fa-edit"></i></a>

                        <a href="'.route('brand.destroy',$row->id).'" class="btn btn-danger btn-sm" id="delete"><i class="fas fa-trash"></i></a>';

                return $action;

            })->rawColumns(['action'])->make(true);
        }

        return view('admin.category.brand.index');
    }
 
    //store method
    public function store(Request $request){

        $validated = $request->validate([
            'brand_name' => 'required|unique:brands|max:55',
        ]);

       $slug =Str::slug($request->brand_name,'-');
       $data = [];
       $data['brand_name']=$request->brand_name;
       $data['brand_slug']=Str::slug($request->brand_name,'-');
       $photo=$request->brand_logo;
       $photoName=$slug.'.'.$photo->getClientOriginalExtension();
       Image::make($photo)->resize(240,120)->save('files/brand/'.$photoName);
       $data['brand_logo']='files/brand/'.$photoName;

       DB::table('brands')->insert($data);

       $notifiaction =['messege'=>'Brand Inserted!','alert-type'=>'success'];
        return redirect()->back()->with($notifiaction);

    }

    //delete method
    public function destroy($id){
        $data = Brand::find($id);
        $img= $data->brand_logo; 
        if(File::exists($img)){
            unlink($img); 
        }
        $data->delete();
        
        $notifiaction =['messege'=>'Childcategory Deleted!','alert-type'=>'success'];
        return redirect()->back()->with($notifiaction);
    }

    //Edit method
    public function edit($id){

        $data =Brand::find($id);
        return view('admin.category.brand.edit',compact('data')); 
        
    }

    //Update method
    public function update(Request $request){



        $slug =Str::slug($request->brand_name,'-');
        $data = [];
        $data['brand_name']=$request->brand_name;
        $data['brand_slug']=Str::slug($request->brand_name,'-');

        if($request->brand_logo){

            if(File::exists($request->old_logo)){
                unlink($request->old_logo); 
            }
            $photo=$request->brand_logo;
            $photoName=$slug.'.'.$photo->getClientOriginalExtension();
            Image::make($photo)->resize(240,120)->save('files/brand/'.$photoName);
            $data['brand_logo']='files/brand/'.$photoName;
            DB::table('brands')->where('id','=',$request->id)->update($data);

            $notifiaction =['messege'=>'Brand Updated!','alert-type'=>'success'];
            return redirect()->back()->with($notifiaction);

        }else{

            $data['brand_logo']= $request->old_logo;
            DB::table('brands')->where('id','=',$request->id)->update($data);
            $notifiaction =['messege'=>'Brand Updated!','alert-type'=>'success'];
            return redirect()->back()->with($notifiaction);
        }
        
        
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Campaign;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Yajra\DataTables\Facades\DataTables;
use Intervention\Image\Facades\Image;

class CampaignController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request){

        if($request->ajax()){
            $data = DB::table('campaigns')->orderBy('id','DESC')->get();

            return DataTables::of($data)

            ->addIndexColumn()
            ->editColumn('status',function($row){
                if ($row->status==1) {
                    return '<a href="#" <span class="badge badge-success">active</span> </a>';
                }else{
                    return '<a href="#" <span class="badge badge-danger">Inactive</span> </a>';
                }
            })
            ->addColumn('action',function($row){

             $action = '<a  data-id="'. $row->id.'" class="edit btn btn-info btn-sm" data-toggle="modal" data-target="#editModal"><i class="fas fa-edit"></i></a>

                        <a href="'.route('campaign.destroy',$row->id).'" class="btn btn-danger btn-sm" id="delete"><i class="fas fa-trash"></i></a>';

                return $action;

            })->rawColumns(['action','status'])->make(true);
        }

        return view('admin.offer.campaign.index');
    }

    //store Campaign
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|unique:campaigns|max:55',
            'start_date' => 'required',
            'image' => 'required',
            'discount' => 'required',
        ]);
       $data = [];
       $data['title']=$request->title;
       $data['start_date']=$request->start_date;
       $data['end_date']=$request->end_date;
       $data['status']=$request->status;
       $data['discount']=$request->discount;
       $data['month']=date('F');
       $data['year']=date('Y');

       //working with image
       $photo=$request->image; $data = [];
       $data['title']=$request->title;
       $data['start_date']=$request->start_date;
       $data['end_date']=$request->end_date;
       $data['status']=$request->status;
       $data['discount']=$request->discount;
       $data['month']=date('F');
       $data['year']=date('Y');
       $slug =Str::slug($request->title,'-'); //its only for image name
       $photoName=$slug.'.'.$photo->getClientOriginalExtension();
       Image::make($photo)->resize(468,90)->save('files/campaign/'.$photoName);
       $data['image']='files/campaign/'.$photoName;

       DB::table('campaigns')->insert($data);

       $notifiaction =['messege'=>'Campaigns Inserted!','alert-type'=>'success'];
        return redirect()->back()->with($notifiaction);

    }

   //delete method
   public function destroy($id)
   {
    $data = Campaign::find($id);
    $img= $data->image; 
    if(File::exists($img)){
        unlink($img); 
    }
    $data->delete();
    
    $notifiaction =['messege'=>'Campaign Deleted!','alert-type'=>'success'];
    return redirect()->back()->with($notifiaction);

    }

    //Edit method
    public function edit($id){

        $data =Campaign::find($id);
        return view('admin.offer.campaign.edit',compact('data')); 
        
    }

    //Update method
    public function update(Request $request){



        $slug =Str::slug($request->title,'-');
        $data = [];
        $data['title']=$request->title;
        $data['start_date']=$request->start_date;
        $data['end_date']=$request->end_date;
        $data['status']=$request->status;
        $data['discount']=$request->discount;

        if($request->image){

            if(File::exists($request->old_image)){
                unlink($request->old_image); 
            }
            $photo=$request->image;
            $photoName=$slug.'.'.$photo->getClientOriginalExtension();
            Image::make($photo)->resize(468,90)->save('files/campaign/'.$photoName);
            $data['image']='files/campaign/'.$photoName;
            DB::table('campaigns')->where('id','=',$request->id)->update($data);

            $notifiaction =['messege'=>'Campaign Updated!','alert-type'=>'success'];
            return redirect()->back()->with($notifiaction);

        }else{

            $data['image']= $request->old_image;
            DB::table('campaigns')->where('id','=',$request->id)->update($data);
            $notifiaction =['messege'=>'Campaign Updated!','alert-type'=>'success'];
            return redirect()->back()->with($notifiaction);
        }
        
        
    }
}

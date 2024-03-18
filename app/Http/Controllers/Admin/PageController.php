<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class PageController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    //index method for showing data
    public function index(){

        $page = DB::table('pages')->latest()->get();
        return view('admin.setting.page.index',compact('page'));
    }

    //Page Create Form
    public function create(){
        
        return view('admin.setting.page.create');
    }

    //Page Store
    public function store(Request $request){

        $data=[];
        $data['page_position']=$request->page_position;
        $data['page_name']=$request->page_name;
        $data['page_slug']=Str::slug($request->page_name,'-');
        $data['page_title']=$request->page_title;
        $data['page_description']=$request->page_description;

        DB::table('pages')->insert($data);
        $notifiaction =['messege'=>'Page Created!','alert-type'=>'success'];
        return redirect()->back()->with($notifiaction);
    }

    //delete method
    public function destroy($id){
        
        DB::table('pages')->where('id','=',$id)->delete();
        
        $notifiaction =['messege'=>'Page Deleted!','alert-type'=>'success'];
        return redirect()->back()->with($notifiaction);
    }

    //edit method
    public function edit($id){
        
        $page = DB::table('pages')->where('id','=',$id)->first();
        return view('admin.setting.page.edit',compact('page'));
        
    }

    //Page Update
    public function update(Request $request,$id){

        $data=[];
        $data['page_position']=$request->page_position;
        $data['page_name']=$request->page_name;
        $data['page_slug']=Str::slug($request->page_name,'-');
        $data['page_title']=$request->page_title;
        $data['page_description']=$request->page_description;

        DB::table('pages')->where('id','=',$id)->update($data);
        $notifiaction =['messege'=>'Page Updated!','alert-type'=>'success'];
        return redirect()->route('page.index')->with($notifiaction);
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class WarehouseController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    //index method for showing data
    public function index(Request $request){

        if($request->ajax()){
            $data = DB::table('warehouses')->latest()->get();

            return DataTables::of($data)

            ->addIndexColumn()
            ->addColumn('action',function($row){

             $action = '<a  data-id="'. $row->id.'" class="edit btn btn-info btn-sm" data-toggle="modal" data-target="#editModal"><i class="fas fa-edit"></i></a>

                        <a href="'.route('warehouse.delete',$row->id).'" class="btn btn-danger btn-sm" id="delete"><i class="fas fa-trash"></i></a>';

                return $action;

            })->rawColumns(['action'])->make(true);
        }

        return view('admin.category.warehouse.index');
    }

    //store method
    public function store(Request $request){

        $validated = $request->validate([
            'warehouse_name' => 'required|unique:warehouses',
        ]);

        $data=[];
        $data['warehouse_name']=$request->warehouse_name;
        $data['warehouse_address']=$request->warehouse_address;
        $data['warehouse_phone']=$request->warehouse_phone;
        DB::table('warehouses')->insert($data);

        $notifiaction =['messege'=>'Warehouse Inserted!','alert-type'=>'success'];
        return redirect()->back()->with($notifiaction);
    }

    //delete method
    public function delete($id){
        
        DB::table('warehouses')->where('id','=',$id)->delete();
        
        $notifiaction =['messege'=>'Warehouses Deleted!','alert-type'=>'success'];
        return redirect()->back()->with($notifiaction);
    }

    //Edit method
    public function edit($id){

        $warehouse = DB::table('warehouses')->where('id','=',$id)->first();
        return view('admin.category.warehouse.edit',compact('warehouse')); 
        
    }

    //Update method
    public function update(Request $request){

        $id = $request->id;
        $data=[];
        $data['warehouse_name']=$request->warehouse_name;
        $data['warehouse_address']=$request->warehouse_address;
        $data['warehouse_phone']=$request->warehouse_phone;
        DB::table('warehouses')->where('id','=',$id)->update($data);

        $notifiaction =['messege'=>'Warehouse Updated!','alert-type'=>'success'];
        return redirect()->back()->with($notifiaction);
     }
}

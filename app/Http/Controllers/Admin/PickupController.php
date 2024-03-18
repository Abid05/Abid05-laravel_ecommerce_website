<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class PickupController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }


    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data=DB::table('pickup_point')->latest()->get();
            return DataTables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){

                        $action = '<a  data-id="'. $row->id.'" class="edit btn btn-info btn-sm" data-toggle="modal" data-target="#edit_Modal"><i class="fas fa-edit"></i></a>

                        <a href="'.route('pickuppoint.delete',$row->id).'" class="btn btn-danger btn-sm" id="delete_pickup"><i class="fas fa-trash"></i></a>';

                    return $action;

            })->rawColumns(['action'])->make(true);     
        }

        return view('admin.pickup.index');
    }

    //store method
    public function store(Request $request)
    {
       $data = array(
            'pickup_point_name' => $request->pickup_point_name,
            'pickup_point_address' => $request->pickup_point_address,
            'pickup_point_phone' => $request->pickup_point_phone,
            'pickup_point_phone_two' => $request->pickup_point_phone_two,
        );
       DB::table('pickup_point')->insert($data);
       return response()->json('successfully Insert!');
    }

    //edit method
    public function edit($id)
    {
        $data=DB::table('pickup_point')->where('id',$id)->first();
        return view('admin.pickup.edit',compact('data'));
    }

    //update method
    public function update(Request $request)
    {
        $id = $request->id;
         $data = array(
            'pickup_point_name' => $request->pickup_point_name,
            'pickup_point_address' => $request->pickup_point_address,
            'pickup_point_phone' => $request->pickup_point_phone,
            'pickup_point_phone_two' => $request->pickup_point_phone_two,
        );
       DB::table('pickup_point')->where('id',$id)->update($data);
       return response()->json('successfully Updated!');
    }

    //delete method
    public function destroy($id)
    {
        DB::table('pickup_point')->where('id',$id)->delete();
        return response()->json('Successfully delete!');
    }
   
}

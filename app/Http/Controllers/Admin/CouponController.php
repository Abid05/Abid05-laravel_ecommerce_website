<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class CouponController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request){

        if($request->ajax()){
            $data = DB::table('coupons')->latest()->get();

            return DataTables::of($data)

            ->addIndexColumn()
            ->addColumn('action',function($row){

             $action = '<a  data-id="'. $row->id.'" class="edit btn btn-info btn-sm" data-toggle="modal" data-target="#editModal"><i class="fas fa-edit"></i></a>

                        <a href="'.route('coupon.destroy',$row->id).'" class="btn btn-danger btn-sm" id="delete_coupon"><i class="fas fa-trash"></i></a>';

                return $action;

            })->rawColumns(['action'])->make(true);
        }

        return view('admin.offer.coupon.index');
    }

    //store coupon 
    public function store(Request $request)
    {
         $data=array(
            'coupon_code' =>$request->coupon_code,
            'type' =>$request->type,
            'coupon_amount' =>$request->coupon_amount,
            'valid_date' =>$request->valid_date,
            'coupon_status' =>$request->coupon_status
         );
         DB::table('coupons')->insert($data);
         return response()->json('Coupon Store!');

    }

    //edit method
    public function edit($id)
    {
        $data=DB::table('coupons')->where('id',$id)->first();
        return view('admin.offer.coupon.edit',compact('data'));
    }

    //Update method
    public function update(Request $request){

        $id = $request->id;
        $data=array(
            'coupon_code' =>$request->coupon_code,
            'type' =>$request->type,
            'coupon_amount' =>$request->coupon_amount,
            'valid_date' =>$request->valid_date,
            'coupon_status' =>$request->coupon_status
         );
         DB::table('coupons')->where('id','=',$id)->update($data);
         return response()->json('Coupon Update!');
     }

    //delete method
    public function delete($id){
        DB::table('coupons')->where('id','=',$id)->delete();
        return response()->json('coupon delete');
        
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Intervention\Image\Facades\Image;

class SettingController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    //seo page show method
    public function seo(){

        $data = DB::table('seos')->first();
        return view('admin.setting.seo',compact('data'));
    }
    //update seo method
    public function seoUpdate(Request $request,$id){
        $data=[];
        $data['meta_title']=$request->meta_title;
        $data['meta_author']=$request->meta_author;
        $data['meta_tag']=$request->meta_tag;
        $data['meta_keyword']=$request->meta_keyword;
        $data['meta_description']=$request->meta_description;
        $data['google_verification']=$request->google_verification;
        $data['alexa_verification']=$request->alexa_verification;
        $data['google_analytics']=$request->google_analytics;
        $data['google_adsense']=$request->google_adsense;

        DB::table('seos')->where('id','=',$id)->update($data);
        $notifiaction =['messege'=>'SEO Setting Inserted!','alert-type'=>'success'];
        return redirect()->back()->with($notifiaction);
    }
    //smtp page show method
    public function smtp(){

        $smtp = DB::table('smtp')->first();
        return view('admin.setting.smtp',compact('smtp'));
    }
    //update smtp method
    public function smtpUpdate(Request $request,$id){
        $data=[];
        $data['mailer']=$request->mailer;
        $data['host']=$request->host;
        $data['port']=$request->port;
        $data['user_name']=$request->user_name;
        $data['password']=$request->password;

        DB::table('smtp')->where('id','=',$id)->update($data);
        $notifiaction =['messege'=>'SMTP Setting Inserted!','alert-type'=>'success'];
        return redirect()->back()->with($notifiaction);
    }

    //website setting
    public function website(){
        $setting = DB::table('settings')->first();
        return view('admin.setting.website_setting',compact('setting'));
    }

    //website update
    public function websiteUpdate(Request $request,$id){
        $data=[];
        $data['currency']=$request->currency;
        $data['phone_one']=$request->phone_one;
        $data['phone_two']=$request->phone_two;
        $data['main_email']=$request->main_email;
        $data['support_email']=$request->support_email;
        $data['address']=$request->address;
        $data['facebook']=$request->facebook;
        $data['twitter']=$request->twitter;
        $data['instagram']=$request->instagram;
        $data['linkedin']=$request->linkedin;
        $data['youtube']=$request->youtube;

        if($request->logo){//jodi new logo diye thake

            $logo=$request->logo;
            $logoName=uniqid().'.'.$logo->getClientOriginalExtension();
            Image::make($logo)->resize(320,120)->save('files/setting/'.$logoName);
            $data['logo']='files/setting/'.$logoName;
        }else{//jodi logo na dey puran tai hobe

            $data['logo']=$request->old_logo;
        }

        if($request->favicon){

            $favicon=$request->favicon;
            $faviconName=uniqid().'.'.$favicon->getClientOriginalExtension();
            Image::make($favicon)->resize(32,32)->save('files/setting/'.$faviconName);
            $data['favicon']='files/setting/'.$faviconName;
        }else{

            $data['favicon']=$request->old_favicon;
        }

        DB::table('settings')->where('id','=',$id)->update($data);
        $notifiaction =['messege'=>'Setting Updated!','alert-type'=>'success'];
        return redirect()->back()->with($notifiaction);
            
    }

      //__payment gateway
      public function PaymentGateway()
      {
          $aamarpay=DB::table('payment_gateway_bd')->first();
          $surjopay=DB::table('payment_gateway_bd')->skip(1)->first();
          $ssl=DB::table('payment_gateway_bd')->skip(2)->first();
          return view('admin.bdpayment_gateway.edit',compact('aamarpay','surjopay','ssl'));
      }
  
      //__aamarpay update
      public function AamarpayUpdate(Request $request)
      {
          $data=array();
          $data['store_id']=$request->store_id;
          $data['signature_key']=$request->signature_key;
          $data['status']=$request->status;
          DB::table('payment_gateway_bd')->where('id',$request->id)->update($data);
          $notification=array('messege' => 'Payment Gateway Update Updated!', 'alert-type' => 'success');
          return redirect()->back()->with($notification);
      }
  
      //__update surjopay
      public function SurjopayUpdate(Request $request)
      {
          $data=array();
          $data['store_id']=$request->store_id;
          $data['signature_key']=$request->signature_key;
          $data['status']=$request->status;
          DB::table('payment_gateway_bd')->where('id',$request->id)->update($data);
          $notification=array('messege' => 'Payment Gateway Update Updated!', 'alert-type' => 'success');
          return redirect()->back()->with($notification);
      }

   
 
}

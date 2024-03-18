<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    //admin after login
    public function admin()
    {
        return view('admin.home');
    }

    //admin custom logout
    public function logout()
    {
        Auth::logout();
        $notifiaction =['messege'=>'You are logged out!','alert-type'=>'success'];
        return redirect()->route('admin.login')->with($notifiaction);
    }

    //password change
    public function passwordChnage(){
        return view('admin.Profile.password_change');
    }
    //Update Password
    public function passwordUpdate(Request $request){

        $validated = $request->validate([
            'old_password' => 'required',
            'password' => 'required|min:6',
        ]);
        
        $current_pass = Auth::user()->password;//login user password get
        $old_pass = $request->old_password;//old_password get form input field
        $new_pass = $request->password;//new-password get form input field

        if(Hash::check($old_pass,$current_pass)){//checking old_pass or current user pass same or not?
            $user = User::find(Auth::id());//current user data get
            $user->password=Hash::make($new_pass);//current user password hashing
            $user->save();//save password
            Auth::logout();//logout admin panel and redirect to login page 
            $notifiaction =['messege'=>'Your Password Changed!','alert-type'=>'success'];
            return redirect()->route('admin.login')->with($notifiaction);
        }else{

            $notifiaction =['messege'=>'Old Password Not Matched!','alert-type'=>'error'];
            return redirect()->back()->with($notifiaction);
        }
    }
}

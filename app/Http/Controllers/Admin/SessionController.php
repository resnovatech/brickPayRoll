<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use URL;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;
use Brian2694\Toastr\Facades\Toastr;
class SessionController extends Controller
{
    public function logout_session()
    {
        Auth::guard('admin')->logout();
        //Toastr::success('Successully logout :)' ,'Success');
        return redirect()->route('admin.login');
    }


    public function lock_screen($email){

        $main_url = URL::previous();

        $lock_email = $email;
        Auth::guard('admin')->logout();
        //dd($lock_email);
        return view('backend.session.lock_screen',compact('lock_email','main_url'));
    }


    public function login_from_session(Request $request){
// dd(1);
         // Validate Login Data
         $request->validate([
            'email' => 'required|max:50',
            'password' => 'required',
        ]);

        // Attempt to login
        if (Auth::guard('admin')->attempt(['email' => $request->email, 'password' => $request->password,'status'=>1], $request->remember)) {

            //dd(1);
            // Redirect to dashboard
           // Toastr::success('Successully login :)' ,'Success');
            //return redirect()->intended(route('admin.dashboard'))->with('success','Successully login');

            return Redirect::to($request->main_url);
        } else {


            // Search using username
            if (Auth::guard('admin')->attempt(['email' => $request->email, 'password' => $request->password,'status'=>0], $request->remember)) {
               // dd(2);
                return back()->with('error','Access Denied,Call Administrator');
            }
            // error
           // Toastr::error('Invalid email and password :)' ,'Success');
           //dd(3);
           return back()->with('error',' password :)');
        }
    }


    public function recovery_password(){
        return view('backend.session.recovery_password');
    }
}

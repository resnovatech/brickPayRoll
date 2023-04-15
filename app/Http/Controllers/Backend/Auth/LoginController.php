<?php

namespace App\Http\Controllers\Backend\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Brian2694\Toastr\Facades\Toastr;
class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::ADMIN_DASHBOARD;

    /**
     * show login form for admin guard
     *
     * @return void
     */
    public function showLoginForm()
    {
        //dd(1);
        if (Auth::guest()) {
            return view('backend.auth.login');

       } else {
        return Redirect::to('/admin');
       }

    }


    /**
     * login admin
     *
     * @param Request $request
     * @return void
     */
    public function login(Request $request)
    {
        // Validate Login Data
        $request->validate([
            'email' => 'required|max:50',
            'password' => 'required',
        ]);

        // Attempt to login
        if (Auth::guard('admin')->attempt(['email' => $request->email, 'password' => $request->password,'status'=>1], $request->remember)) {
            // Redirect to dashboard
            Toastr::success('Successully login :)' ,'Success');
            return redirect()->intended(route('admin.dashboard'))->with('success','Successully login');
        } else {
            // Search using username
            if (Auth::guard('admin')->attempt(['email' => $request->email, 'password' => $request->password,'status'=>0], $request->remember)) {
                return back()->with('error','Access Denied,Call Administrator');
            }
            // error
            Toastr::error('Invalid email and password :)' ,'Success');

            return back();
        }
    }

    /**
     * logout admin guard
     *
     * @return void
     */
    public function logout()
    {
        Auth::guard('admin')->logout();
        Toastr::success('Successully logout :)' ,'Success');
        return redirect()->route('admin.login');
    }
}

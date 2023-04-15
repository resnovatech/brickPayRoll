<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use URL;
use App\Models\Admin;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;
use Brian2694\Toastr\Facades\Toastr;
use App\Notifications\ForgetPasswordNotification;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
class ForgetPasswordController extends Controller
{
    public function check_mail_from_list(Request $request){

       $type_email = $request->type_email;
       $data = Admin::where('email',$type_email)->value('email');



   // $data = view('backend.product.main_search_button_product',compact('product_list','total_serial_number','search'))->render();
    return response()->json($data);
    }


    public function send_mail_get_from_list(Request $request){

            $useremail = $request->useremail;

            $main_data = Admin::where('email',$useremail)->first();

            $name = $main_data->name;

            $id = $main_data->email;
            $user = Admin::where('email',$useremail)->get();

            Notification::send($user, new ForgetPasswordNotification($name,$id));

            return redirect('admin/successfully_mail_send/'.$id)->with('success','Email Sent Successfully!');

    }


    public function password_reset_page($id){

        $user = Admin::where('email',$id)->first();

        return view('backend.session.password_reset_page',compact('user'));

    }

    public function successfully_mail_send($id){
        $user = $id;

        return view('backend.session.successful_mailsend',compact('user'));
    }

    public function password_change_confirmed(Request $request){

        $admins = Admin::find($request->id);
        $admins->password = Hash::make($request->password);
        $admins->save();

        return redirect()->route('admin.login')->with('success','Password Successfully Changed!');

    }
}

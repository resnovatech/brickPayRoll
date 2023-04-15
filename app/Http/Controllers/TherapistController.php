<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Therapist;
use App\Models\Admin;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
class TherapistController extends Controller
{
    public $user;


    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $this->user = Auth::guard('admin')->user();
            return $next($request);
        });
    }


    public function index(){


        if (is_null($this->user) || !$this->user->can('therapistView')) {
            abort(403, 'Sorry !! You are Unauthorized to View !');
               }

          $therapistList = Therapist::latest()->get();



               return view('backend.therapistList.index',compact('therapistList'));
           }


           public function store(Request $request){

            if (is_null($this->user) || !$this->user->can('therapistAdd')) {
                abort(403, 'Sorry !! You are Unauthorized to Add !');
            }

            $request->validate([
                'name' => 'required',
                'email' => 'required',
                'phone_or_mobile_number' => 'required',
                'address' => 'required',
                'nid_number' => 'required',
                'nationality' => 'required',
                'dob' => 'required',
                'years_of_experience' => 'required',

            ]);


            $staff = new Therapist();
            $staff->admin_id = Auth::guard('admin')->user()->id;
            $staff->name = $request->name;
            $staff->email = $request->email;
            $staff->phone_or_mobile_number = $request->phone_or_mobile_number;
            $staff->address = $request->address;
            $staff->nid_number = $request->nid_number;
            $staff->nationality = $request->nationality;
            $staff->dob = $request->dob;
            $staff->years_of_experience = $request->years_of_experience;
            $staff->save();

            $staffId = $staff->id;




            $admins = new Admin();
            $admins->name = $request->name;
            $admins->staff_id = $staffId;
            $admins->phone = $request->phone_or_mobile_number;
            $admins->username = Str::slug($request->name);
            $admins->email = $request->email;
            $admins->password = Hash::make(12345678);
            $admins->save();
            $admins->assignRole('therapist');





    return redirect()->route('therapist.index')->with('success','Added successfully!');



        }


        public function update(Request $request,$id){

            if (is_null($this->user) || !$this->user->can('therapistUpdate')) {
                abort(403, 'Sorry !! You are Unauthorized to Update !');
            }

            $staff = Therapist::findOrFail($id);

            $input = $request->all();

            $staff->fill($input)->save();


            Admin::where('therapist_id', $id)
       ->update([
           'name' => $request->name,
           'phone' => $request->phone_or_mobile_number,
           'email' => $request->email,
        ]);



    return redirect()->route('therapist.index')->with('success','Updated successfully!');



        }


        public function destroy($id)
    {

        if (is_null($this->user) || !$this->user->can('therapistDelete')) {
            abort(403, 'Sorry !! You are Unauthorized to Delete !');
        }


        Therapist::destroy($id);
        return redirect()->route('therapist.index')->with('error','Deleted successfully!');
    }
}

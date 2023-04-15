<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Staff;
use App\Models\Admin;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
class StaffController extends Controller
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


        if (is_null($this->user) || !$this->user->can('staffView')) {
            abort(403, 'Sorry !! You are Unauthorized to View !');
               }

          $staffList = Staff::latest()->get();



               return view('backend.staffList.index',compact('staffList'));
           }


           public function store(Request $request){

            if (is_null($this->user) || !$this->user->can('staffAdd')) {
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


            $staff = new Staff();
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
            $admins->assignRole('staff');





    return redirect()->route('staff.index')->with('success','Added successfully!');



        }


        public function update(Request $request,$id){

            if (is_null($this->user) || !$this->user->can('staffUpdate')) {
                abort(403, 'Sorry !! You are Unauthorized to Update !');
            }

            $staff = Staff::findOrFail($id);

            $input = $request->all();

            $staff->fill($input)->save();


            Admin::where('staff_id', $id)
       ->update([
           'name' => $request->name,
           'phone' => $request->phone_or_mobile_number,
           'email' => $request->email,
        ]);



    return redirect()->route('staff.index')->with('success','Updated successfully!');



        }


        public function destroy($id)
    {

        if (is_null($this->user) || !$this->user->can('staffDelete')) {
            abort(403, 'Sorry !! You are Unauthorized to Delete !');
        }


        Staff::destroy($id);
        return redirect()->route('staff.index')->with('error','Deleted successfully!');
    }

}

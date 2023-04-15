<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use DB;
use App\Models\Company;
use App\Models\Department;
use App\Models\Designation;
class DesignationController extends Controller
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


        if (is_null($this->user) || !$this->user->can('designation_view')) {
            abort(403, 'Sorry !! You are Unauthorized to View !');
               }

          $departmentLists = Department::latest()->get();

          $designationLists = Designation::latest()->get();

               return view('backend.designation.index',compact('departmentLists','designationLists'));
           }


           public function store(Request $request){

            if (is_null($this->user) || !$this->user->can('designation_add')) {
                abort(403, 'Sorry !! You are Unauthorized to Add !');
            }

            $request->validate([
                'designation_name' => 'required',
                'designation_status' => 'required',
                'department_id' => 'required',
              ]);




             $input = $request->all();

             Designation::create($input);




    return redirect()->route('designation.index')->with('success','Added successfully!');



        }





        public function update(Request $request,$id){

            if (is_null($this->user) || !$this->user->can('designation_update')) {
                abort(403, 'Sorry !! You are Unauthorized to Update !');
            }

            $medicine = Designation::findOrFail($id);

            $input = $request->all();

            $medicine->fill($input)->save();

    return redirect()->route('designation.index')->with('success','Updated successfully!');



        }


        public function destroy($id)
    {

        if (is_null($this->user) || !$this->user->can('designation_delete')) {
            abort(403, 'Sorry !! You are Unauthorized to Delete !');
        }


        Designation::destroy($id);
        return redirect()->route('designation.index')->with('error','Deleted successfully!');
    }
}

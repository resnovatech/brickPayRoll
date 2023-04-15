<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use DB;
use App\Models\Company;
use App\Models\Department;
class DepartmentController extends Controller
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


        if (is_null($this->user) || !$this->user->can('department_view')) {
            abort(403, 'Sorry !! You are Unauthorized to View !');
               }

          $departmentLists = Department::latest()->get();



               return view('backend.department.index',compact('departmentLists'));
           }


           public function store(Request $request){

            if (is_null($this->user) || !$this->user->can('department_add')) {
                abort(403, 'Sorry !! You are Unauthorized to Add !');
            }

            $request->validate([
                'department_name' => 'required',
                'department_status' => 'required',
              ]);




             $input = $request->all();

             Department::create($input);




    return redirect()->route('department.index')->with('success','Added successfully!');



        }





        public function update(Request $request,$id){

            if (is_null($this->user) || !$this->user->can('department_update')) {
                abort(403, 'Sorry !! You are Unauthorized to Update !');
            }

            $medicine = Department::findOrFail($id);

            $input = $request->all();

            $medicine->fill($input)->save();

    return redirect()->route('department.index')->with('success','Updated successfully!');



        }


        public function destroy($id)
    {

        if (is_null($this->user) || !$this->user->can('department_delete')) {
            abort(403, 'Sorry !! You are Unauthorized to Delete !');
        }


        Department::destroy($id);
        return redirect()->route('department.index')->with('error','Deleted successfully!');
    }
}

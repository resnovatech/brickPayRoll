<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use DB;
use App\Models\Company;
use App\Models\Department;
use App\Models\Designation;
use App\Models\Bank;
use App\Models\Employee;
class EmployeeController extends Controller
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


        if (is_null($this->user) || !$this->user->can('employee_view')) {
            abort(403, 'Sorry !! You are Unauthorized to View !');
               }


               $designationLists = Designation::latest()->get();
          $employeeLists = Employee::latest()->get();
          $companyList = Company::latest()->get();
               return view('backend.employee.index',compact('employeeLists'));
           }


           public function create(){


            if (is_null($this->user) || !$this->user->can('employee_add')) {
                abort(403, 'Sorry !! You are Unauthorized to add !');
                   }



                   $designationLists = Designation::latest()->get();
                   $employeeLists = Employee::latest()->get();
                   $companyList = Company::latest()->get();

                   return view('backend.employee.create',compact('employeeLists','designationLists','companyList'));
               }


               public function edit($id){


                if (is_null($this->user) || !$this->user->can('employee_update')) {
                    abort(403, 'Sorry !! You are Unauthorized to edit !');
                       }



                       $designationLists = Designation::latest()->get();
                       $employeeLists = Employee::find($id);
                       $companyList = Company::latest()->get();

                       return view('backend.employee.edit',compact('employeeLists','designationLists','companyList'));
                   }


           public function store(Request $request){

            if (is_null($this->user) || !$this->user->can('employee_add')) {
                abort(403, 'Sorry !! You are Unauthorized to Add !');
            }

            $request->validate([
                'employee_id' => 'required',
                'name' => 'required',
                'mobile_number' => 'required',
                'email' => 'required',
                'name' => 'required',
                'gender' => 'required',
                'designation_id' => 'required',
                'department' => 'required',
                'company_id' => 'required',
                'job_location' => 'required',
                'status' => 'required',
                'discontinue_date' => 'required',
              ]);




             $input = $request->all();

             Employee::create($input);




    return redirect()->route('employee.index')->with('success','Added successfully!');



        }





        public function update(Request $request,$id){

            if (is_null($this->user) || !$this->user->can('employee_update')) {
                abort(403, 'Sorry !! You are Unauthorized to Update !');
            }

            $medicine = Employee::findOrFail($id);

            $input = $request->all();

            $medicine->fill($input)->save();

    return redirect()->route('employee.index')->with('success','Updated successfully!');



        }


        public function destroy($id)
    {

        if (is_null($this->user) || !$this->user->can('employee_delete')) {
            abort(403, 'Sorry !! You are Unauthorized to Delete !');
        }


        Employee::destroy($id);
        return redirect()->route('employee.index')->with('error','Deleted successfully!');
    }
}

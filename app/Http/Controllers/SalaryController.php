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
use App\Models\Salary;
class SalaryController extends Controller
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


        if (is_null($this->user) || !$this->user->can('salary_view')) {
            abort(403, 'Sorry !! You are Unauthorized to View !');
               }


               $designationLists = Designation::latest()->get();
          $salaryLists = Salary::latest()->get();
          $companyList = Company::latest()->get();
               return view('backend.salary.index',compact('salaryLists'));
           }


           public function create(){


            if (is_null($this->user) || !$this->user->can('salary_add')) {
                abort(403, 'Sorry !! You are Unauthorized to add !');
                   }



                   $designationLists = Designation::latest()->get();
                   $employeeLists = Employee::latest()->get();
                   $bankList = Bank::latest()->get();

                   return view('backend.salary.create',compact('employeeLists','designationLists','bankList'));
               }


               public function edit($id){


                if (is_null($this->user) || !$this->user->can('salary_update')) {
                    abort(403, 'Sorry !! You are Unauthorized to edit !');
                       }



                       $salaryLists = Salary::find($id);
                       $employeeLists = Employee::latest()->get();
                   $bankList = Bank::latest()->get();

                       return view('backend.salary.edit',compact('employeeLists','salaryLists','bankList'));
                   }


           public function store(Request $request){

            if (is_null($this->user) || !$this->user->can('salary_add')) {
                abort(403, 'Sorry !! You are Unauthorized to Add !');
            }

            $request->validate([
                'employee_id' => 'required',
                'date_of_joining' => 'required',
                'employee_category' => 'required',
                'gross_salary' => 'required',
                'basic_fifty_percentage_of_gross' => 'required',
                'house_rent_fifty_percentage_of_basic' => 'required',
                'medical_fifteen_percentage_of_basic' => 'required',
                'convenience_ten_percentage_of_basic' => 'required',
                'food_fifteen_percentage_of_basic' => 'required',
                'other_allow' => 'required',
                'bank_name' => 'required',
                'bank_account_number' => 'required',
              ]);




             $input = $request->all();

             Salary::create($input);




    return redirect()->route('salary.index')->with('success','Added successfully!');



        }





        public function update(Request $request,$id){

            if (is_null($this->user) || !$this->user->can('salary_update')) {
                abort(403, 'Sorry !! You are Unauthorized to Update !');
            }

            $medicine = Salary::findOrFail($id);

            $input = $request->all();

            $medicine->fill($input)->save();

    return redirect()->route('salary.index')->with('success','Updated successfully!');



        }


        public function destroy($id)
    {

        if (is_null($this->user) || !$this->user->can('salary_delete')) {
            abort(403, 'Sorry !! You are Unauthorized to Delete !');
        }


        Salary::destroy($id);
        return redirect()->route('salary.index')->with('error','Deleted successfully!');
    }
}

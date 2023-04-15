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
use App\Models\OverTime;
class OvertimeController extends Controller
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


        if (is_null($this->user) || !$this->user->can('overtime_view')) {
            abort(403, 'Sorry !! You are Unauthorized to View !');
               }

               $employeeLists = Employee::latest()->get();

          $overTimeLists = OverTime::latest()->get();

               return view('backend.overtime.index',compact('overTimeLists','employeeLists'));
           }







           public function store(Request $request){

            if (is_null($this->user) || !$this->user->can('overtime_add')) {
                abort(403, 'Sorry !! You are Unauthorized to Add !');
            }

            $request->validate([
                'employee_id' => 'required',
                'overtime_date' => 'required',
                'overtime_hour' => 'required',
                'overtime_pay' => 'required',
                'description' => 'required',
             ]);




             $input = $request->all();

             OverTime::create($input);




    return redirect()->route('overtime.index')->with('success','Added successfully!');



        }





        public function update(Request $request,$id){

            if (is_null($this->user) || !$this->user->can('overtime_update')) {
                abort(403, 'Sorry !! You are Unauthorized to Update !');
            }

            $medicine = OverTime::findOrFail($id);

            $input = $request->all();

            $medicine->fill($input)->save();

    return redirect()->route('overtime.index')->with('success','Updated successfully!');



        }


        public function destroy($id)
    {

        if (is_null($this->user) || !$this->user->can('overtime_delete')) {
            abort(403, 'Sorry !! You are Unauthorized to Delete !');
        }


        OverTime::destroy($id);
        return redirect()->route('overtime.index')->with('error','Deleted successfully!');
    }
}

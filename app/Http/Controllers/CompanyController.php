<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use DB;
use App\Models\Company;
class CompanyController extends Controller
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


        if (is_null($this->user) || !$this->user->can('company_view')) {
            abort(403, 'Sorry !! You are Unauthorized to View !');
               }

          $companyList = Company::latest()->get();



               return view('backend.company.index',compact('companyList'));
           }


           public function store(Request $request){

            if (is_null($this->user) || !$this->user->can('company_add')) {
                abort(403, 'Sorry !! You are Unauthorized to Add !');
            }

            $request->validate([
                 'company_name' => 'required',
                 'company_address' => 'required',
                 'company_phone' => 'required',
                 'company_logo' => 'required',

            ]);



             $company = new Company();
             $company->admin_id = Auth::guard('admin')->user()->id;
             $company->company_name = $request->company_name;
             $company->company_address = $request->company_address;
             $company->company_phone = $request->company_phone;


             if ($request->hasfile('company_logo')) {
                 $file = $request->file('company_logo');
                 $extension = $file->getClientOriginalName();
                 $filename = $extension;
                 $file->move('public/uploads/', $filename);
                 $company->company_logo =  'public/uploads/'.$filename;

             }


             $company->save();




    return redirect()->route('company.index')->with('success','Added successfully!');



        }


        public function update(Request $request,$id){

            if (is_null($this->user) || !$this->user->can('company_update')) {
                abort(403, 'Sorry !! You are Unauthorized to Update !');
            }



            $company =Company::find($id);
             $company->admin_id = Auth::guard('admin')->user()->id;
             $company->company_name = $request->company_name;
             $company->company_address = $request->company_address;
             $company->company_phone = $request->company_phone;


             if ($request->hasfile('company_logo')) {
                 $file = $request->file('company_logo');
                 $extension = $file->getClientOriginalName();
                 $filename = $extension;
                 $file->move('public/uploads/', $filename);
                 $company->company_logo =  'public/uploads/'.$filename;

             }


             $company->save();


    return redirect()->route('company.index')->with('success','Updated successfully!');



        }


        public function destroy($id)
        {

            if (is_null($this->user) || !$this->user->can('company_delete')) {
                abort(403, 'Sorry !! You are Unauthorized to Delete !');
            }


            Company::destroy($id);
            return redirect()->route('company.index')->with('error','Deleted successfully!');
        }
}

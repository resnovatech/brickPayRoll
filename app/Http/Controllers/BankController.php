<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use DB;
use App\Models\Company;
use App\Models\Department;
use App\Models\Designation;
use App\Models\Bank;
class BankController extends Controller
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


        if (is_null($this->user) || !$this->user->can('bank_view')) {
            abort(403, 'Sorry !! You are Unauthorized to View !');
               }



          $bankLists = Bank::latest()->get();

               return view('backend.bank.index',compact('bankLists'));
           }


           public function store(Request $request){

            if (is_null($this->user) || !$this->user->can('bank_add')) {
                abort(403, 'Sorry !! You are Unauthorized to Add !');
            }

            $request->validate([
                'bank_name' => 'required',
                'branch' => 'required',
                'account_number' => 'required',
              ]);




             $input = $request->all();

             Bank::create($input);




    return redirect()->route('bank.index')->with('success','Added successfully!');



        }





        public function update(Request $request,$id){

            if (is_null($this->user) || !$this->user->can('bank_update')) {
                abort(403, 'Sorry !! You are Unauthorized to Update !');
            }

            $medicine = Bank::findOrFail($id);

            $input = $request->all();

            $medicine->fill($input)->save();

    return redirect()->route('bank.index')->with('success','Updated successfully!');



        }


        public function destroy($id)
    {

        if (is_null($this->user) || !$this->user->can('bank_delete')) {
            abort(403, 'Sorry !! You are Unauthorized to Delete !');
        }


        Bank::destroy($id);
        return redirect()->route('bank.index')->with('error','Deleted successfully!');
    }
}

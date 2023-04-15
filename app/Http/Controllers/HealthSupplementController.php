<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\HealthSupplement;
use Illuminate\Support\Facades\Auth;
class HealthSupplementController extends Controller
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


        if (is_null($this->user) || !$this->user->can('healthSupplementsAdd')) {
            abort(403, 'Sorry !! You are Unauthorized to View !');
               }

          $healthSupplements = HealthSupplement::latest()->get();



               return view('backend.healthSupplements.index',compact('healthSupplements'));
           }


           public function store(Request $request){

            if (is_null($this->user) || !$this->user->can('healthSupplementsAdd')) {
                abort(403, 'Sorry !! You are Unauthorized to Add !');
            }

            $request->validate([
                'name' => 'required',
                'amount' => 'required',
              ]);




             $input = $request->all();

             HealthSupplement::create($input);




    return redirect()->route('healthSupplements.index')->with('success','Added successfully!');



        }





        public function update(Request $request,$id){

            if (is_null($this->user) || !$this->user->can('healthSupplementsUpdate')) {
                abort(403, 'Sorry !! You are Unauthorized to Update !');
            }

            $medicine = HealthSupplement::findOrFail($id);

            $input = $request->all();

            $medicine->fill($input)->save();

    return redirect()->route('healthSupplements.index')->with('success','Updated successfully!');



        }


        public function destroy($id)
    {

        if (is_null($this->user) || !$this->user->can('healthSupplementsDelete')) {
            abort(403, 'Sorry !! You are Unauthorized to Delete !');
        }


        HealthSupplement::destroy($id);
        return redirect()->route('healthSupplements.index')->with('error','Deleted successfully!');
    }
}

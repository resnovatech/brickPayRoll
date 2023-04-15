<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Medicine;
use Illuminate\Support\Facades\Auth;
class MedicineController extends Controller
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


        if (is_null($this->user) || !$this->user->can('medicineListsAdd')) {
            abort(403, 'Sorry !! You are Unauthorized to View !');
               }

          $medicineLists = Medicine::latest()->get();



               return view('backend.medicineLists.index',compact('medicineLists'));
           }


           public function store(Request $request){

            if (is_null($this->user) || !$this->user->can('medicineListsAdd')) {
                abort(403, 'Sorry !! You are Unauthorized to Add !');
            }

            $request->validate([
                'name' => 'required',
                'amount' => 'required',
              ]);




             $input = $request->all();

             Medicine::create($input);




    return redirect()->route('medicineLists.index')->with('success','Added successfully!');



        }





        public function update(Request $request,$id){

            if (is_null($this->user) || !$this->user->can('medicineListsUpdate')) {
                abort(403, 'Sorry !! You are Unauthorized to Update !');
            }

            $medicine = Medicine::findOrFail($id);

            $input = $request->all();

            $medicine->fill($input)->save();

    return redirect()->route('medicineLists.index')->with('success','Updated successfully!');



        }


        public function destroy($id)
    {

        if (is_null($this->user) || !$this->user->can('medicineListsDelete')) {
            abort(403, 'Sorry !! You are Unauthorized to Delete !');
        }


        Medicine::destroy($id);
        return redirect()->route('medicineLists.index')->with('error','Deleted successfully!');
    }

}

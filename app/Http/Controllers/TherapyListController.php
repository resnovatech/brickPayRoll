<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TherapyList;
use App\Models\TherapyDetail;
use App\Models\TherapyIngredient;
use Illuminate\Support\Facades\Auth;
class TherapyListController extends Controller
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


        if (is_null($this->user) || !$this->user->can('therapyListsAdd')) {
            abort(403, 'Sorry !! You are Unauthorized to View !');
               }

          $therapyLists = TherapyList::latest()->get();

          $therapyIngredients = TherapyIngredient::latest()->get();

               return view('backend.therapyLists.index',compact('therapyLists','therapyIngredients'));
           }


           public function store(Request $request){

            if (is_null($this->user) || !$this->user->can('therapyListsAdd')) {
                abort(403, 'Sorry !! You are Unauthorized to Add !');
            }

            $request->validate([
                'name' => 'required',
                'therapy_list_id.*' => 'required',
                'therapy_ingredient_id.*' => 'required',
                'quantity.*' => 'required',
                'unit.*' => 'required',
              ]);







             $inputAllData = $request->all();



             $insertTherapyList = new TherapyList();
             $insertTherapyList->name = $request->name;
             $insertTherapyList->amount = $request->amount;
             $insertTherapyList->save();

             $therapyId = $insertTherapyList->id;

             $therapyIngredientId = $inputAllData['therapy_ingredient_id'];



             if (array_key_exists("therapy_ingredient_id", $inputAllData)){

                foreach($therapyIngredientId as $key => $therapyIngredientId){
                 $therapyDetail= new TherapyDetail();
                 $therapyDetail->therapy_ingredient_id =$inputAllData['therapy_ingredient_id'][$key];
                 $therapyDetail->quantity=$inputAllData['quantity'][$key];
                 $therapyDetail->unit=$inputAllData['unit'][$key];
                 $therapyDetail->therapy_list_id   = $therapyId;
                 $therapyDetail->save();

                }
                }



    return redirect()->route('therapyLists.index')->with('success','Added successfully!');



        }





        public function update(Request $request,$id){

            if (is_null($this->user) || !$this->user->can('therapyListsUpdate')) {
                abort(403, 'Sorry !! You are Unauthorized to Update !');
            }

 //dd($request->all());

             $inputAllData = $request->all();



             $insertTherapyList =TherapyList::find($id);
             $insertTherapyList->name = $request->name;
             $insertTherapyList->amount = $request->amount;
             $insertTherapyList->save();

             $therapyId = $insertTherapyList->id;

             $therapyIngredientId = $inputAllData['therapy_ingredient_id'];



             if (array_key_exists("therapy_ingredient_id", $inputAllData)){


                $deletePreviousData = TherapyDetail::where('therapy_list_id',$therapyId)->delete();


                foreach($therapyIngredientId as $key => $therapyIngredientId){
                 $therapyDetail= new TherapyDetail();
                 $therapyDetail->therapy_ingredient_id =$inputAllData['therapy_ingredient_id'][$key];
                 $therapyDetail->quantity=$inputAllData['quantity'][$key];
                 $therapyDetail->unit=$inputAllData['unit'][$key];
                 $therapyDetail->therapy_list_id   = $therapyId;
                 $therapyDetail->save();

                }
                }




    return redirect()->route('therapyLists.index')->with('success','Updated successfully!');



        }


        public function destroy($id)
    {

        if (is_null($this->user) || !$this->user->can('therapyListsDelete')) {
            abort(403, 'Sorry !! You are Unauthorized to Delete !');
        }


        TherapyList::destroy($id);
        return redirect()->route('therapyLists.index')->with('error','Deleted successfully!');
    }
}

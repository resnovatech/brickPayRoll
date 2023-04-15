<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TherapyIngredient;
use Illuminate\Support\Facades\Auth;
class TherapyIngredientController extends Controller
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


        if (is_null($this->user) || !$this->user->can('therapyIngredientsAdd')) {
            abort(403, 'Sorry !! You are Unauthorized to View !');
               }

          $therapyIngredients = TherapyIngredient::latest()->get();



               return view('backend.therapyIngredients.index',compact('therapyIngredients'));
           }


           public function store(Request $request){

            if (is_null($this->user) || !$this->user->can('therapyIngredientsAdd')) {
                abort(403, 'Sorry !! You are Unauthorized to Add !');
            }

            $request->validate([
                'name' => 'required',

              ]);




             $input = $request->all();

             TherapyIngredient::create($input);




    return redirect()->route('therapyIngredients.index')->with('success','Added successfully!');



        }





        public function update(Request $request,$id){

            if (is_null($this->user) || !$this->user->can('therapyIngredientsUpdate')) {
                abort(403, 'Sorry !! You are Unauthorized to Update !');
            }

            $medicine = TherapyIngredient::findOrFail($id);

            $input = $request->all();

            $medicine->fill($input)->save();

    return redirect()->route('therapyIngredients.index')->with('success','Updated successfully!');



        }


        public function destroy($id)
    {

        if (is_null($this->user) || !$this->user->can('therapyIngredientsDelete')) {
            abort(403, 'Sorry !! You are Unauthorized to Delete !');
        }


        TherapyIngredient::destroy($id);
        return redirect()->route('therapyIngredients.index')->with('error','Deleted successfully!');
    }
}

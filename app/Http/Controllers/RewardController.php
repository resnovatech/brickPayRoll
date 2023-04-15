<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reward;
use Illuminate\Support\Facades\Auth;
class RewardController extends Controller
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


        if (is_null($this->user) || !$this->user->can('rewardView')) {
            abort(403, 'Sorry !! You are Unauthorized to View !');
               }

          $rewardList = Reward::latest()->get();



               return view('backend.rewardList.index',compact('rewardList'));
           }


           public function store(Request $request){

            if (is_null($this->user) || !$this->user->can('rewardAdd')) {
                abort(403, 'Sorry !! You are Unauthorized to Add !');
            }

            $request->validate([
                'name' => 'required',
                'reward_for' => 'required',
                'point' => 'required',
                'in_exchange' => 'required',
                'amount' => 'required',

              ]);


              $input = $request->all();

              Reward::create($input);






    return redirect()->route('reward.index')->with('success','Added successfully!');



        }


        public function update(Request $request,$id){

            if (is_null($this->user) || !$this->user->can('rewardUpdate')) {
                abort(403, 'Sorry !! You are Unauthorized to Update !');
            }

            $reward = Reward::findOrFail($id);

            $input = $request->all();

            $reward->fill($input)->save();






    return redirect()->route('reward.index')->with('success','Updated successfully!');



        }


        public function destroy($id)
    {

        if (is_null($this->user) || !$this->user->can('rewardDelete')) {
            abort(403, 'Sorry !! You are Unauthorized to Delete !');
        }


        Reward::destroy($id);
        return redirect()->route('reward.index')->with('error','Deleted successfully!');
    }
}

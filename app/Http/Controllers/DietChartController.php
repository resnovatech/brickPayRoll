<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DietChart;
use Illuminate\Support\Facades\Auth;
class DietChartController extends Controller
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


        if (is_null($this->user) || !$this->user->can('dietChartsAdd')) {
            abort(403, 'Sorry !! You are Unauthorized to View !');
               }

          $dietChartList = DietChart::latest()->get();



               return view('backend.dietChart.index',compact('dietChartList'));
           }


           public function store(Request $request){

            if (is_null($this->user) || !$this->user->can('dietChartsAdd')) {
                abort(403, 'Sorry !! You are Unauthorized to Add !');
            }

            $request->validate([
                'name' => 'required',
                'file' => 'required',
              ]);


             // Create New User
             $dietChartList = new DietChart();

             $dietChartList->name = $request->name;


             if ($request->hasfile('file')) {
                 $file = $request->file('file');
                 $extension = $file->getClientOriginalName();
                 $filename = $extension;
                 $file->move('public/uploads/', $filename);
                 $dietChartList->file =  'public/uploads/'.$filename;

             }


             $dietChartList->save();




    return redirect()->route('dietCharts.index')->with('success','Added successfully!');



        }





        public function update(Request $request,$id){

            if (is_null($this->user) || !$this->user->can('dietChartsUpdate')) {
                abort(403, 'Sorry !! You are Unauthorized to Update !');
            }




             // Create New User
             $dietChartList = DietChart::find($id);

             $dietChartList->name = $request->name;


             if ($request->hasfile('file')) {
                 $file = $request->file('file');
                 $extension = $file->getClientOriginalName();
                 $filename = $extension;
                 $file->move('public/uploads/', $filename);
                 $dietChartList->file =  'public/uploads/'.$filename;

             }


             $dietChartList->save();




    return redirect()->route('dietCharts.index')->with('success','Updated successfully!');



        }


        public function destroy($id)
    {

        if (is_null($this->user) || !$this->user->can('dietChartsDelete')) {
            abort(403, 'Sorry !! You are Unauthorized to Delete !');
        }


        DietChart::destroy($id);
        return redirect()->route('dietCharts.index')->with('error','Deleted successfully!');
    }

}

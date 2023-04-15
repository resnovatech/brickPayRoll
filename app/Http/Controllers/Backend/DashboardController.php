<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Admin;

use DB;
use Carbon\Carbon;
use App\Models\SystemInformation;
class DashboardController extends Controller
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
if (is_null($this->user) || !$this->user->can('dashboard.view')) {
            // abort(403, 'Sorry !! You are Unauthorized to view dashboard !');

            return redirect('/admin/logout_session');
        }


        $ins_vat = 1;






        $count_admin = Admin::where('id','!=',1)->count();




//dd($count_admin);

    	return view('backend.index',compact('count_admin','ins_vat'));
    }
}

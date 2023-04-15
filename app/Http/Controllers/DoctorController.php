<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Doctor;
use App\Models\DoctorConsultDate;
use Illuminate\Support\Facades\Auth;
class DoctorController extends Controller
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


        if (is_null($this->user) || !$this->user->can('doctorView')) {
            abort(403, 'Sorry !! You are Unauthorized to View !');
               }

          $doctorList = Doctor::latest()->get();



               return view('backend.doctor.index',compact('doctorList'));
           }


    public function create(){
 if (is_null($this->user) || !$this->user->can('doctorAdd')) {
            abort(403, 'Sorry !! You are Unauthorized to Add !');
        }
        return view('backend.doctor.create');
    }



    public function store(Request $request){

        if (is_null($this->user) || !$this->user->can('doctorAdd')) {
            abort(403, 'Sorry !! You are Unauthorized to Add !');
        }

        $request->validate([
            'name' => 'required',
            'address' => 'required',
            'gender' => 'required',
            'email_address' => 'required',
            'phone_or_mobile_number' => 'required',
            'nid_number' => 'required',
            'nationality' => 'required',
            'years_of_experience' => 'required',
            'doctor_certificate' => 'required',
            'doctor_day.*' => 'required',
            'start_time.*' => 'required',
            'end_time.*' => 'required',
        ]);


         // Create New User
         $doctor = new Doctor();
         $doctor->admin_id = Auth::guard('admin')->user()->id;
         $doctor->name = $request->name;
         $doctor->address = $request->address;
         $doctor->gender = $request->gender;
         $doctor->phone_or_mobile_number = $request->phone_or_mobile_number;
         $doctor->email_address = $request->email_address;
         $doctor->nid_number = $request->nid_number;
         $doctor->nationality = $request->nationality;
         $doctor->years_of_experience = $request->years_of_experience;

         if ($request->hasfile('doctor_certificate')) {
             $file = $request->file('doctor_certificate');
             $extension = $file->getClientOriginalName();
             $filename = $extension;
             $file->move('public/uploads/', $filename);
             $doctor->doctor_certificate =  'public/uploads/'.$filename;

         }


         $doctor->save();

         $doctorId = $doctor->id;

         $inputAllData = $request->all();

         $doctorDay = $inputAllData['doctor_day'];



         if (array_key_exists("doctor_day", $inputAllData)){

            foreach($doctorDay as $key => $doctorDay){
             $doctorConsultTime = new DoctorConsultDate();
             $doctorConsultTime->day=$inputAllData['doctor_day'][$key];
             $doctorConsultTime->start_time=$inputAllData['start_time'][$key];
             $doctorConsultTime->end_time=$inputAllData['end_time'][$key];
             $doctorConsultTime->doctor_id  = $doctorId;
             $doctorConsultTime->save();

            }
            }


return redirect()->route('doctorList')->with('success','Added successfully!');



    }


    public function update(Request $request){

        if (is_null($this->user) || !$this->user->can('doctorUpdate')) {
            abort(403, 'Sorry !! You are Unauthorized to Add !');
        }



         // Create New User
         $doctor = Doctor::find($request->id);
         $doctor->admin_id = Auth::guard('admin')->user()->id;
         $doctor->name = $request->name;
         $doctor->address = $request->address;
         $doctor->gender = $request->gender;
         $doctor->phone_or_mobile_number = $request->phone_or_mobile_number;
         $doctor->email_address = $request->email_address;
         $doctor->nid_number = $request->nid_number;
         $doctor->nationality = $request->nationality;
         $doctor->years_of_experience = $request->years_of_experience;

         if ($request->hasfile('doctor_certificate')) {
             $file = $request->file('doctor_certificate');
             $extension = $file->getClientOriginalName();
             $filename = $extension;
             $file->move('public/uploads/', $filename);
             $doctor->doctor_certificate =  'public/uploads/'.$filename;

         }


         $doctor->save();

         $doctorId = $doctor->id;

         $inputAllData = $request->all();

         $doctorDay = $inputAllData['doctor_day'];



         if (array_key_exists("doctor_day", $inputAllData)){


            $deletePreviousData = DoctorConsultDate::where('doctor_id',$doctorId)->delete();

            foreach($doctorDay as $key => $doctorDay){
             $doctorConsultTime = new DoctorConsultDate();
             $doctorConsultTime->day=$inputAllData['doctor_day'][$key];
             $doctorConsultTime->start_time=$inputAllData['start_time'][$key];
             $doctorConsultTime->end_time=$inputAllData['end_time'][$key];
             $doctorConsultTime->doctor_id  = $doctorId;
             $doctorConsultTime->save();

            }
            }


return redirect()->route('doctorList')->with('success','Updated successfully!');



    }


    public function edit($id){


        if (is_null($this->user) || !$this->user->can('doctorUpdate')) {
            abort(403, 'Sorry !! You are Unauthorized to View !');
               }

          $doctorList = Doctor::find($id);

  return view('backend.doctor.edit',compact('doctorList'));
           }


           public function view($id){


            if (is_null($this->user) || !$this->user->can('doctorView')) {
                abort(403, 'Sorry !! You are Unauthorized to View !');
                   }

              $doctorList = Doctor::find($id);

      return view('backend.doctor.view',compact('doctorList'));
               }


           public function delete($id)
           {

               if (is_null($this->user) || !$this->user->can('doctorDelete')) {
                   abort(403, 'Sorry !! You are Unauthorized to delete any doctor !');
               }
               $admins = Doctor::find($id);
               if (!is_null($admins)) {
                   $admins->delete();
               }


               return back()->with('error','Deleted successfully!');
           }
}

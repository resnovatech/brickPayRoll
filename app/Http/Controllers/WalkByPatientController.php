<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\WalkByPatient;
use App\Models\Patient;
use App\Models\Bill;
use App\Models\WalkByPatientService;
use App\Models\DoctorAppointment;
use App\Models\TherapyAppointment;
use App\Models\TherapyAppointmentDateAndTime;
use App\Models\TherapyAppointmentDetail;
class WalkByPatientController extends Controller
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


        if (is_null($this->user) || !$this->user->can('WalkByPatientView')) {
            abort(403, 'Sorry !! You are Unauthorized to View !');
               }

          $walkByPatientList = WalkByPatient::latest()->get();



               return view('backend.walkByPatient.index',compact('walkByPatientList'));
           }


    public function create(){
 if (is_null($this->user) || !$this->user->can('WalkByPatientAdd')) {
            abort(403, 'Sorry !! You are Unauthorized to Add !');
        }
        return view('backend.walkByPatient.create');
    }



    public function store(Request $request){

        if (is_null($this->user) || !$this->user->can('WalkByPatientAdd')) {
            abort(403, 'Sorry !! You are Unauthorized to Add !');
        }

        $request->validate([
            'image' => 'required',
            'name' => 'required',
            'refer_from' => 'required',
            'age' => 'required',
            'gender' => 'required',
            'address' => 'required',
            'email_address' => 'required',
            'phone_or_mobile_number' => 'required',
            'nid_number' => 'required',
            'nationality' => 'required',
            'how_did_you_come_to_know_about_this_center' => 'required',
            'do_you_have_earlier_experience_of_ayurveda_please_give_details' => 'required',
            'do_you_have_symptoms_in_past_one_weak' => 'required',
            'covid_test_result' => 'required',
            'disease_name.*' => 'required',
            'detail.*' => 'required',
        ]);




         // Create New User
         $walkByPatient = new WalkByPatient();
         $walkByPatient->admin_id = Auth::guard('admin')->user()->id;
         $walkByPatient->name = $request->name;
         $walkByPatient->patient_reg_id = date('dmy').time();
         $walkByPatient->refer_from = $request->refer_from;
         $walkByPatient->age = $request->age;
         $walkByPatient->gender = $request->gender;
         $walkByPatient->address = $request->address;
         $walkByPatient->email_address = $request->email_address;
         $walkByPatient->phone_or_mobile_number = $request->phone_or_mobile_number;
         $walkByPatient->nid_number = $request->nid_number;
         $walkByPatient->nationality = $request->nationality;
         $walkByPatient->how_did_you_come_to_know_about_this_center = $request->how_did_you_come_to_know_about_this_center;
         $walkByPatient->do_you_have_earlier_experience_of_ayurveda_please_give_details = $request->do_you_have_earlier_experience_of_ayurveda_please_give_details;
         $walkByPatient->do_you_have_symptoms_in_past_one_weak = $request->do_you_have_symptoms_in_past_one_weak;
         $walkByPatient->covid_test_result = $request->covid_test_result;
         if ($request->hasfile('image')) {
             $file = $request->file('image');
             $extension = $file->getClientOriginalName();
             $filename = $extension;
             $file->move('public/uploads/', $filename);
             $walkByPatient->image =  'public/uploads/'.$filename;

         }


         $walkByPatient->save();

         $walkByPatientId = $walkByPatient->id;

         $inputAllData = $request->all();

         $walkByPatientName = $inputAllData['disease_name'];



         if (array_key_exists("disease_name", $inputAllData)){

            foreach($walkByPatientName as $key => $walkByPatientName){
             $walkByPatientService = new WalkByPatientService();
             $walkByPatientService->name=$inputAllData['disease_name'][$key];
             $walkByPatientService->detail=$inputAllData['detail'][$key];
             $walkByPatientService->walk_by_patient_id   = $walkByPatientId;
             $walkByPatientService->save();

            }
            }


return redirect()->route('walkByPatients.index')->with('success','Added successfully!');



    }


    public function edit($id)
    {

        if (is_null($this->user) || !$this->user->can('WalkByPatientUpdate')) {
            abort(403, 'Sorry !! You are Unauthorized to Edit !');
        }


        $walkByPatientList = WalkByPatient::find($id);
        return view('backend.walkByPatient.edit',compact('walkByPatientList'));
    }
    
     public function show($id)
    {

    


        $walkByPatientList = WalkByPatient::find($id);
        //dd($walkByPatientListnew);
        $totalAmount = Bill::where('patient_id',$walkByPatientList->patient_reg_id)->sum('total_amount');
          $walkByPatientService = WalkByPatientService::where('walk_by_patient_id',$id)->latest()->get();
          $doctorAppoinmentList = DoctorAppointment::where('patient_id',$walkByPatientList->patient_reg_id)->latest()->get();
          
          $therapyAppointmentList = TherapyAppointment::where('patient_id',$walkByPatientList->patient_reg_id)->select('id')->get();
          
          $convert_name_title = $therapyAppointmentList->implode("id", " ");
          $separated_data_title = explode(" ", $convert_name_title);
                                
                               $getAppoinmentDetail =  TherapyAppointmentDetail::whereIn('therapy_appointment_id',$separated_data_title)->latest()->get();

        
        return view('backend.walkByPatient.view',compact('walkByPatientList','walkByPatientService','totalAmount','doctorAppoinmentList','getAppoinmentDetail'));
    }



    public function transferToPatientList($id){

        $walkByPatientList = WalkByPatient::find($id);

         // Create New User
         $patient = new Patient();
         $patient->admin_id = Auth::guard('admin')->user()->id;
         $patient->name = $walkByPatientList->name;
         $patient->patient_id = date('dmy').time();
         $patient->refer_from = $walkByPatientList->refer_from;
         $patient->age = $walkByPatientList->age;
         $patient->gender = $walkByPatientList->gender;
         $patient->address = $walkByPatientList->address;
         $patient->email_address = $walkByPatientList->email_address;
         $patient->phone_or_mobile_number = $walkByPatientList->phone_or_mobile_number;
         $patient->nid_number = $walkByPatientList->nid_number;
         $patient->nationality = $walkByPatientList->nationality;
         $patient->how_did_you_come_to_know_about_this_center = $walkByPatientList->how_did_you_come_to_know_about_this_center;
         $patient->do_you_have_earlier_experience_of_ayurveda_please_give_details = $walkByPatientList->do_you_have_earlier_experience_of_ayurveda_please_give_details;
         $patient->do_you_have_symptoms_in_past_one_weak = $walkByPatientList->do_you_have_symptoms_in_past_one_weak;
         $patient->covid_test_result = $walkByPatientList->covid_test_result;
         $patient->image = $walkByPatientList->image;
         $patient->save();

         return redirect()->route('walkByPatients.index')->with('success','Transfared successfully!');
    }



    public function update(Request $request,$id){

        if (is_null($this->user) || !$this->user->can('WalkByPatientUpdate')) {
            abort(403, 'Sorry !! You are Unauthorized to Add !');
        }


         // Create New User
         $walkByPatient =WalkByPatient::find($id);
         $walkByPatient->name = $request->name;
         $walkByPatient->refer_from = $request->refer_from;
         $walkByPatient->age = $request->age;
         $walkByPatient->gender = $request->gender;
         $walkByPatient->address = $request->address;
         $walkByPatient->email_address = $request->email_address;
         $walkByPatient->phone_or_mobile_number = $request->phone_or_mobile_number;
         $walkByPatient->nid_number = $request->nid_number;
         $walkByPatient->nationality = $request->nationality;
         $walkByPatient->how_did_you_come_to_know_about_this_center = $request->how_did_you_come_to_know_about_this_center;
         $walkByPatient->do_you_have_earlier_experience_of_ayurveda_please_give_details = $request->do_you_have_earlier_experience_of_ayurveda_please_give_details;
         $walkByPatient->do_you_have_symptoms_in_past_one_weak = $request->do_you_have_symptoms_in_past_one_weak;
         $walkByPatient->covid_test_result = $request->covid_test_result;
         if ($request->hasfile('image')) {
             $file = $request->file('image');
             $extension = $file->getClientOriginalName();
             $filename = $extension;
             $file->move('public/uploads/', $filename);
             $walkByPatient->image =  'public/uploads/'.$filename;

         }


         $walkByPatient->save();

         $walkByPatientId = $walkByPatient->id;

         $inputAllData = $request->all();

         $walkByPatientName = $inputAllData['disease_name'];



         if (array_key_exists("disease_name", $inputAllData)){


            $deletePreviousData = WalkByPatientService::where('walk_by_patient_id',$walkByPatientId)->delete();


            foreach($walkByPatientName as $key => $walkByPatientName){
             $walkByPatientService = new WalkByPatientService();
             $walkByPatientService->name=$inputAllData['disease_name'][$key];
             $walkByPatientService->detail=$inputAllData['detail'][$key];
             $walkByPatientService->walk_by_patient_id   = $walkByPatientId;
             $walkByPatientService->save();

            }
            }


return redirect()->route('walkByPatients.index')->with('success','Updated successfully!');



    }


    public function destroy($id)
    {

        if (is_null($this->user) || !$this->user->can('WalkByPatientDelete')) {
            abort(403, 'Sorry !! You are Unauthorized to Delete !');
        }


        WalkByPatient::destroy($id);
        return redirect()->route('walkByPatients.index')->with('error','Deleted successfully!');
    }
}

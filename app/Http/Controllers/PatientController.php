<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\Patient;
use App\Models\PatientFile;
use App\Models\Bill;
use App\Models\WalkByPatientService;
use App\Models\DoctorAppointment;
use App\Models\TherapyAppointment;
use App\Models\TherapyAppointmentDateAndTime;
use App\Models\TherapyAppointmentDetail;
class PatientController extends Controller
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


        if (is_null($this->user) || !$this->user->can('PatientView')) {
            abort(403, 'Sorry !! You are Unauthorized to View !');
               }

          $patientList = Patient::latest()->get();



               return view('backend.patient.index',compact('patientList'));
           }


    public function create(){
 if (is_null($this->user) || !$this->user->can('PatientAdd')) {
            abort(403, 'Sorry !! You are Unauthorized to Add !');
        }
        return view('backend.patient.create');
    }



    public function store(Request $request){

        if (is_null($this->user) || !$this->user->can('PatientAdd')) {
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
         $patient = new Patient();
         $patient->admin_id = Auth::guard('admin')->user()->id;
         $patient->name = $request->name;
         $patient->patient_id = date('dmy').time();
         $patient->refer_from = $request->refer_from;
         $patient->age = $request->age;
         $patient->gender = $request->gender;
         $patient->address = $request->address;
         $patient->email_address = $request->email_address;
         $patient->phone_or_mobile_number = $request->phone_or_mobile_number;
         $patient->nid_number = $request->nid_number;
         $patient->nationality = $request->nationality;
         $patient->how_did_you_come_to_know_about_this_center = $request->how_did_you_come_to_know_about_this_center;
         $patient->do_you_have_earlier_experience_of_ayurveda_please_give_details = $request->do_you_have_earlier_experience_of_ayurveda_please_give_details;
         $patient->do_you_have_symptoms_in_past_one_weak = $request->do_you_have_symptoms_in_past_one_weak;
         $patient->covid_test_result = $request->covid_test_result;
         if ($request->hasfile('image')) {
             $file = $request->file('image');
             $extension = $file->getClientOriginalName();
             $filename = $extension;
             $file->move('public/uploads/', $filename);
             $patient->image =  'public/uploads/'.$filename;

         }


         $patient->save();

         $patientId = $patient->id;

         $inputAllData = $request->all();

         $patientFileName = $inputAllData['file_name'];



         if (array_key_exists("file_name", $inputAllData)){

            foreach($patientFileName as $key => $patientFileName){
             $patientFileName = new PatientFile();
             $patientFileName->name=$inputAllData['file_name'][$key];


             $file = $inputAllData['file'][$key];
             $extension = $file->getClientOriginalName();
             $filename = $extension;
             $file->move('public/uploads/', $filename);
             $patientFileName->file =  'public/uploads/'.$filename;
             $patientFileName->patient_id   = $patientId;
             $patientFileName->save();

            }
            }


return redirect()->route('patients.index')->with('success','Added successfully!');



    }


    public function edit($id)
    {

        if (is_null($this->user) || !$this->user->can('PatientUpdate')) {
            abort(403, 'Sorry !! You are Unauthorized to Edit !');
        }


        $patientList = Patient::find($id);
        return view('backend.patient.edit',compact('patientList'));
    }
    
     public function show($id)
    {

    


        $walkByPatientList = Patient::find($id);
        //dd($walkByPatientListnew);
        $totalAmount = Bill::where('patient_id',$walkByPatientList->patient_id)->sum('total_amount');
          $walkByPatientService = PatientFile::where('patient_id',$id)->latest()->get();
          $doctorAppoinmentList = DoctorAppointment::where('patient_id',$walkByPatientList->patient_id)->latest()->get();
          
          $therapyAppointmentList = TherapyAppointment::where('patient_id',$walkByPatientList->patient_id)->select('id')->get();
          
          $convert_name_title = $therapyAppointmentList->implode("id", " ");
          $separated_data_title = explode(" ", $convert_name_title);
                                
                               $getAppoinmentDetail =  TherapyAppointmentDetail::whereIn('therapy_appointment_id',$separated_data_title)->latest()->get();

        
        return view('backend.patient.view',compact('walkByPatientList','walkByPatientService','totalAmount','doctorAppoinmentList','getAppoinmentDetail'));
    }



    public function update(Request $request,$id){

        if (is_null($this->user) || !$this->user->can('PatientUpdate')) {
            abort(403, 'Sorry !! You are Unauthorized to Add !');
        }


         // Create New User
         $patient =Patient::find($id);
         $patient->name = $request->name;

         $patient->refer_from = $request->refer_from;
         $patient->age = $request->age;
         $patient->gender = $request->gender;
         $patient->address = $request->address;
         $patient->email_address = $request->email_address;
         $patient->phone_or_mobile_number = $request->phone_or_mobile_number;
         $patient->nid_number = $request->nid_number;
         $patient->nationality = $request->nationality;
         $patient->how_did_you_come_to_know_about_this_center = $request->how_did_you_come_to_know_about_this_center;
         $patient->do_you_have_earlier_experience_of_ayurveda_please_give_details = $request->do_you_have_earlier_experience_of_ayurveda_please_give_details;
         $patient->do_you_have_symptoms_in_past_one_weak = $request->do_you_have_symptoms_in_past_one_weak;
         $patient->covid_test_result = $request->covid_test_result;
         if ($request->hasfile('image')) {
             $file = $request->file('image');
             $extension = $file->getClientOriginalName();
             $filename = $extension;
             $file->move('public/uploads/', $filename);
             $patient->image =  'public/uploads/'.$filename;

         }


         $patient->save();

         $patientId = $patient->id;

         $inputAllData = $request->all();

         $patientFileName = $inputAllData['file_name'];



         if (array_key_exists("file_name", $inputAllData) || array_key_exists("file", $inputAllData)){



            foreach($patientFileName as $key => $patientFileName){
             $patientFileName = new PatientFile();
             $patientFileName->name=$inputAllData['file_name'][$key];


             $file = $inputAllData['file'][$key];
             $extension = $file->getClientOriginalName();
             $filename = $extension;
             $file->move('public/uploads/', $filename);
             $patientFileName->file =  'public/uploads/'.$filename;
             $patientFileName->patient_id   = $patientId;
             $patientFileName->save();

            }
            }






return redirect()->route('patients.index')->with('success','Updated successfully!');



    }


    public function patientFileUpdate(Request $request){

        //dd($request->all());

        $patientFileName =PatientFile::find($request->mainid);
        $patientFileName->name = $request->mainname;

        if ($request->hasfile('mainfile')) {
            $file = $request->file('mainfile');
            $extension = $file->getClientOriginalName();
            $filename = $extension;
            $file->move('public/uploads/', $filename);
            $patientFileName->file =  'public/uploads/'.$filename;

        }
$patientFileName->save();
        return redirect()->back()->with('success','Updated successfully!');

    }


    public function delete($id)
    {

        if (is_null($this->user) || !$this->user->can('PatientDelete')) {
            abort(403, 'Sorry !! You are Unauthorized to Delete !');
        }


        PatientFile::destroy($id);
        return redirect()->back()->with('error','Deleted successfully!');
    }


    public function destroy($id)
    {

        if (is_null($this->user) || !$this->user->can('PatientDelete')) {
            abort(403, 'Sorry !! You are Unauthorized to Delete !');
        }


       Patient::destroy($id);
        return redirect()->route('patients.index')->with('error','Deleted successfully!');
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\PatientAdmit;
use App\Models\Patient;
use App\Models\TherapyList;
use App\Models\Doctor;
use App\Models\Bill;
use App\Models\WalkByPatientService;
use App\Models\DoctorAppointment;
use App\Models\TherapyAppointment;
use App\Models\TherapyAppointmentDateAndTime;
use App\Models\TherapyAppointmentDetail;
class PatientAdmitController extends Controller
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


        if (is_null($this->user) || !$this->user->can('PatientAdmitView')) {
            abort(403, 'Sorry !! You are Unauthorized to View !');
               }

          $patientAdmitList = PatientAdmit::latest()->get();



               return view('backend.patientAdmit.index',compact('patientAdmitList'));
           }


    public function create(){
 if (is_null($this->user) || !$this->user->can('PatientAdmitAdd')) {
            abort(403, 'Sorry !! You are Unauthorized to Add !');
        }
        $patientList = Patient::latest()->get();
        $doctorList = Doctor::latest()->get();
        $therapyLists = TherapyList::latest()->get();
        return view('backend.patientAdmit.create',compact('doctorList','therapyLists','patientList'));
    }



    public function edit($id)
    {

        if (is_null($this->user) || !$this->user->can('PatientAdmitUpdate')) {
            abort(403, 'Sorry !! You are Unauthorized to Edit !');
        }


        $patientAdmitList = PatientAdmit::find($id);
        $patientList = Patient::latest()->get();
        $doctorList = Doctor::latest()->get();
        $therapyLists = TherapyList::latest()->get();
        return view('backend.patientAdmit.edit',compact('patientList','patientAdmitList','doctorList','therapyLists'));
    }
    
    
     public function show($id)
    {

    


        $walkByPatientList = PatientAdmit::find($id);
        //dd($walkByPatientListnew);
        $totalAmount = Bill::where('patient_id',$walkByPatientList->patient_id)->sum('total_amount');
       
          $doctorAppoinmentList = DoctorAppointment::where('patient_id',$walkByPatientList->patient_id)->latest()->get();
          
          $therapyAppointmentList = TherapyAppointment::where('patient_id',$walkByPatientList->patient_id)->select('id')->get();
          
          $convert_name_title = $therapyAppointmentList->implode("id", " ");
          $separated_data_title = explode(" ", $convert_name_title);
                                
                               $getAppoinmentDetail =  TherapyAppointmentDetail::whereIn('therapy_appointment_id',$separated_data_title)->latest()->get();
//dd(1);
        
        return view('backend.patientAdmit.view',compact('walkByPatientList','totalAmount','doctorAppoinmentList','getAppoinmentDetail'));
    }





    public function store(Request $request){

        if (is_null($this->user) || !$this->user->can('PatientAdmitAdd')) {
            abort(403, 'Sorry !! You are Unauthorized to Add !');
        }

        // dd($request->all());

        $request->validate([
            'patient_type' => 'required',
            'name' => 'required',
            'age' => 'required',
            'gender' => 'required',
            'address' => 'required',
            'email_address' => 'required',
            'phone_or_mobile_number' => 'required',
            'nid_number' => 'required',
            'nationality' => 'required',
            'doctor_id' => 'required',
            'type_of_accommodation' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
            'treatment_package_name.*' => 'required',
            'routine' => 'required',
        ]);

        $treatmentPackageName = implode(",",$request->treatment_package_name);

        if($request->patient_type == 'Already Registered'){



             // Create New User
         $patientAdmit = new PatientAdmit();
         $patientAdmit->admin_id = Auth::guard('admin')->user()->id;
         $patientAdmit->name = $request->name;
         $patientAdmit->patient_type = $request->patient_type;
         $patientAdmit->patient_id = $request->patient_id_old;
         $patientAdmit->doctor_id = $request->doctor_id;
         $patientAdmit->recommended_doctor_name = $request->doctor_id;
         $patientAdmit->age = $request->age;
         $patientAdmit->gender = $request->gender;
         $patientAdmit->address = $request->address;
         $patientAdmit->email_address = $request->email_address;
         $patientAdmit->phone_or_mobile_number = $request->phone_or_mobile_number;
         $patientAdmit->nid_number = $request->nid_number;
         $patientAdmit->nationality = $request->nationality;
         $patientAdmit->type_of_accommodation = $request->type_of_accommodation;
         $patientAdmit->start_date = $request->start_date;
         $patientAdmit->end_date = $request->end_date;
         $patientAdmit->treatment_package_name = $treatmentPackageName;
         if ($request->hasfile('routine')) {
             $file = $request->file('routine');
             $extension = $file->getClientOriginalName();
             $filename = $extension;
             $file->move('public/uploads/', $filename);
             $patientAdmit->routine =  'public/uploads/'.$filename;

         }


         $patientAdmit->save();



        }else{



                 // Create New User
         $patientAdmit = new PatientAdmit();
         $patientAdmit->admin_id = Auth::guard('admin')->user()->id;
         $patientAdmit->name = $request->name;
         $patientAdmit->patient_type = $request->patient_type;
         $patientAdmit->patient_id = $request->patient_id_new;
         $patientAdmit->doctor_id = $request->doctor_id;
         $patientAdmit->recommended_doctor_name = $request->doctor_id;
         $patientAdmit->age = $request->age;
         $patientAdmit->gender = $request->gender;
         $patientAdmit->address = $request->address;
         $patientAdmit->email_address = $request->email_address;
         $patientAdmit->phone_or_mobile_number = $request->phone_or_mobile_number;
         $patientAdmit->nid_number = $request->nid_number;
         $patientAdmit->nationality = $request->nationality;
         $patientAdmit->type_of_accommodation = $request->type_of_accommodation;
         $patientAdmit->start_date = $request->start_date;
         $patientAdmit->end_date = $request->end_date;
         $patientAdmit->treatment_package_name = $treatmentPackageName;
         if ($request->hasfile('routine')) {
             $file = $request->file('routine');
             $extension = $file->getClientOriginalName();
             $filename = $extension;
             $file->move('public/uploads/', $filename);
             $patientAdmit->routine =  'public/uploads/'.$filename;

         }


         $patientAdmit->save();


         // Create New User
         $patient = new Patient();
         $patient->admin_id = Auth::guard('admin')->user()->id;
         $patient->name = $request->name;
         $patient->patient_id = $request->patient_id_new;
         $patient->refer_from = 'N/A';
         $patient->age = $request->age;
         $patient->gender = $request->gender;
         $patient->address = $request->address;
         $patient->email_address = $request->email_address;
         $patient->phone_or_mobile_number = $request->phone_or_mobile_number;
         $patient->nid_number = $request->nid_number;
         $patient->nationality = $request->nationality;
         $patient->how_did_you_come_to_know_about_this_center = 'N/A';
         $patient->do_you_have_earlier_experience_of_ayurveda_please_give_details = 'N/A';
         $patient->do_you_have_symptoms_in_past_one_weak = 'N/A';
         $patient->covid_test_result = 'N/A';
         $patient->image = 'N/A';
         $patient->save();



        }



return redirect()->route('patientAdmits.index')->with('success','Added successfully!');



    }




        public function update(Request $request,$id){

        $treatmentPackageName = implode(",",$request->treatment_package_name);

        if($request->patient_type == 'Already Registered'){

             // Create New User
             $patientAdmit = PatientAdmit::find($id);

             $patientAdmit->name = $request->name;
             $patientAdmit->patient_type = $request->patient_type;
             $patientAdmit->patient_id = $request->patient_id_old;
             $patientAdmit->doctor_id = $request->doctor_id;
             $patientAdmit->recommended_doctor_name = $request->doctor_id;
             $patientAdmit->age = $request->age;
             $patientAdmit->gender = $request->gender;
             $patientAdmit->address = $request->address;
             $patientAdmit->email_address = $request->email_address;
             $patientAdmit->phone_or_mobile_number = $request->phone_or_mobile_number;
             $patientAdmit->nid_number = $request->nid_number;
             $patientAdmit->nationality = $request->nationality;
             $patientAdmit->type_of_accommodation = $request->type_of_accommodation;
             $patientAdmit->start_date = $request->start_date;
             $patientAdmit->end_date = $request->end_date;
             $patientAdmit->treatment_package_name = $treatmentPackageName;
             if ($request->hasfile('routine')) {
                 $file = $request->file('routine');
                 $extension = $file->getClientOriginalName();
                 $filename = $extension;
                 $file->move('public/uploads/', $filename);
                 $patientAdmit->routine =  'public/uploads/'.$filename;

             }


             $patientAdmit->save();



            }else{



                     // Create New User
             $patientAdmit = PatientAdmit::find($id);

             $patientAdmit->name = $request->name;
             $patientAdmit->patient_type = $request->patient_type;
             $patientAdmit->patient_id = $request->patient_id_new;
             $patientAdmit->doctor_id = $request->doctor_id;
             $patientAdmit->recommended_doctor_name = $request->doctor_id;
             $patientAdmit->age = $request->age;
             $patientAdmit->gender = $request->gender;
             $patientAdmit->address = $request->address;
             $patientAdmit->email_address = $request->email_address;
             $patientAdmit->phone_or_mobile_number = $request->phone_or_mobile_number;
             $patientAdmit->nid_number = $request->nid_number;
             $patientAdmit->nationality = $request->nationality;
             $patientAdmit->type_of_accommodation = $request->type_of_accommodation;
             $patientAdmit->start_date = $request->start_date;
             $patientAdmit->end_date = $request->end_date;
             $patientAdmit->treatment_package_name = $treatmentPackageName;
             if ($request->hasfile('routine')) {
                 $file = $request->file('routine');
                 $extension = $file->getClientOriginalName();
                 $filename = $extension;
                 $file->move('public/uploads/', $filename);
                 $patientAdmit->routine =  'public/uploads/'.$filename;

             }


             $patientAdmit->save();

            }



    return redirect()->route('patientAdmits.index')->with('success','Update successfully!');


    }




    public function destroy($id)
    {

        if (is_null($this->user) || !$this->user->can('PatientAdmitDelete')) {
            abort(403, 'Sorry !! You are Unauthorized to Delete !');
        }


        PatientAdmit::destroy($id);
        return redirect()->route('patientAdmits.index')->with('error','Deleted successfully!');
    }


    
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\Doctor;
use App\Models\Patient;
use App\Models\WalkByPatient;
use App\Models\DoctorAppointment;
class DoctorAppointmentController extends Controller
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


        if (is_null($this->user) || !$this->user->can('doctorAppointmentView')) {
            abort(403, 'Sorry !! You are Unauthorized to View !');
               }

          $doctorAppointmentList = DoctorAppointment::where('appointment_date',date('Y-m-d'))->latest()->get();



               return view('backend.doctorAppointment.index',compact('doctorAppointmentList'));
           }


    public function create(){
 if (is_null($this->user) || !$this->user->can('doctorAppointmentAdd')) {
            abort(403, 'Sorry !! You are Unauthorized to Add !');
        }
        $walkByPatientList = WalkByPatient::latest()->get();
        $patientList = Patient::latest()->get();
        $doctorList = Doctor::latest()->get();
//dd(1);
        return view('backend.doctorAppointment.create',compact('doctorList','walkByPatientList','patientList'));
    }



    public function edit($id)
    {

        if (is_null($this->user) || !$this->user->can('doctorAppointmentUpdate')) {
            abort(403, 'Sorry !! You are Unauthorized to Edit !');
        }


        $doctorAppointmentList = DoctorAppointment::find($id);
        $walkByPatientList = WalkByPatient::latest()->get();
        $patientList = Patient::latest()->get();
        $doctorList = Doctor::latest()->get();

        if($doctorAppointmentList->patient_type == 'Patient'){

            $patientListInfo = Patient::where('patient_id',$doctorAppointmentList->patient_id)->first();

        }else{

            $patientListInfo = WalkByPatient::where('patient_reg_id',$doctorAppointmentList->patient_id)->first();

        }
        return view('backend.doctorAppointment.edit',compact('patientListInfo','patientList','doctorAppointmentList','doctorList','walkByPatientList'));
    }



    public function destroy($id)
    {

        if (is_null($this->user) || !$this->user->can('doctorAppointmentDelete')) {
            abort(403, 'Sorry !! You are Unauthorized to Delete !');
        }


        DoctorAppointment::destroy($id);
        return redirect()->route('doctorAppointments.index')->with('error','Deleted successfully!');
    }


    public function store(Request $request){


        if (is_null($this->user) || !$this->user->can('doctorAppointmentAdd')) {
            abort(403, 'Sorry !! You are Unauthorized to Add !');
        }

        // dd($request->all());

        $request->validate([
            'patient_id' => 'required',
            'doctor_id' => 'required',
            'appointment_date' => 'required',

        ]);


       $getSerialValue =  DoctorAppointment::where('appointment_date',$request->appointment_date)
       ->where('doctor_id',$request->doctor_id)
       ->value('serial_number');

       if(empty($getSerialValue)){


        $finalSerialValue = 1;

       }else{
        $finalSerialValue = $getSerialValue + 1;

       }


         $doctorAppointment = new DoctorAppointment();
         $doctorAppointment->admin_id = Auth::guard('admin')->user()->id;
         $doctorAppointment->patient_id = $request->patient_id;
         $doctorAppointment->doctor_id = $request->doctor_id;
         $doctorAppointment->appointment_date = $request->appointment_date;
         $doctorAppointment->patient_type = $request->patient_type;
         $doctorAppointment->serial_number = $finalSerialValue;
         $doctorAppointment->save();



         return redirect()->route('doctorAppointments.index')->with('success','Added successfully!');


    }


    public function update(Request $request,$id){


        if (is_null($this->user) || !$this->user->can('doctorAppointmentAdd')) {
            abort(403, 'Sorry !! You are Unauthorized to Add !');
        }




         $doctorAppointment = DoctorAppointment::find($id);
         $doctorAppointment->patient_id = $request->patient_id;
         $doctorAppointment->doctor_id = $request->doctor_id;
         $doctorAppointment->appointment_date = $request->appointment_date;
         $doctorAppointment->patient_type = $request->patient_type;
         $doctorAppointment->save();



         return redirect()->route('doctorAppointments.index')->with('success','Updated successfully!');


    }



}

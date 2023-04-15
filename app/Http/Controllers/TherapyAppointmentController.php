<?php

namespace App\Http\Controllers;
use Auth;
use Illuminate\Http\Request;
use App\Models\Doctor;
use App\Models\Patient;
use App\Models\WalkByPatient;
use App\Models\DoctorAppointment;
use App\Models\PatientHistory;
use App\Models\TherapyList;
use App\Models\Medicine;
use App\Models\HealthSupplement;
use App\Models\PatientTherapy;
use App\Models\PatientHerb;
use App\Models\PatientMedicalSupplement;
use DB;
use App\Models\Therapist;
use App\Models\TherapyAppointment;
use App\Models\TherapyAppointmentDateAndTime;
use App\Models\TherapyAppointmentDetail;
class TherapyAppointmentController extends Controller
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
        if (is_null($this->user) || !$this->user->can('therapyAppointmentView')) {
                   abort(403, 'Sorry !! You are Unauthorized to Add !');
               }
               $therapyAppointmentDateAndTimeList = TherapyAppointmentDateAndTime::where('date',date('Y-m-d'))->latest()->get();
       //dd(1);
               return view('backend.therapyAppointment.index',compact('therapyAppointmentDateAndTimeList'));
           }



    public function create(){
        if (is_null($this->user) || !$this->user->can('therapyAppointmentAdd')) {
                   abort(403, 'Sorry !! You are Unauthorized to Add !');
               }
               $patientHistory = PatientHistory::where('status',0)->latest()->get();
       //dd(1);
               return view('backend.therapyAppointment.create',compact('patientHistory'));
           }


           public function getTherapyAppointmentDetail(Request $request){

                    $mainId = $request->patient_id;
                    $patientId = PatientHistory::where('id',$mainId)->value('patient_id');


                    $getNameFromWalkByPatient = DB::table('walk_by_patients')
                    ->where('patient_reg_id',$patientId)->value('name');
                    $getNameFromPatient = DB::table('patients')
                    ->where('patient_id',$patientId)->value('name');


                    $getAgeFromWalkByPatient = DB::table('walk_by_patients')
                    ->where('patient_reg_id',$patientId)->value('age');
                    $getAgeFromPatient = DB::table('patients')
                    ->where('patient_id',$patientId)->value('age');


                    $getEmailFromWalkByPatient = DB::table('walk_by_patients')
                    ->where('patient_reg_id',$patientId)->value('email_address');
                    $getEmailFromPatient = DB::table('patients')
                    ->where('patient_id',$patientId)->value('email_address');


                    if(empty($getNameFromWalkByPatient)){

                        $name = $getNameFromPatient;

                    }else{
                        $name = $getNameFromWalkByPatient;

                    }


                    if(empty($getAgeFromWalkByPatient)){
                        $age = $getAgeFromPatient;

                    }else{

                        $age = $getAgeFromWalkByPatient;
                    }


                    if(empty($getEmailFromWalkByPatient)){
                        $email = $getEmailFromPatient;

                    }else{

                        $email = $getEmailFromWalkByPatient;

                    }


                    $data = view('backend.therapyAppointment.getTherapyAppointmentDetail',compact('name','age','email'))->render();
                    return response()->json($data);


           }


           public function getTherapyListDetail(Request $request){


                    $mainId = $request->patient_id;
                    $patientTherapyList = PatientTherapy::where('patient_history_id',$mainId)->latest()->get();
                    $therapistList = Therapist::latest()->get();

                    $data = view('backend.therapyAppointment.getTherapyListDetail',compact('patientTherapyList','therapistList'))->render();
                    return response()->json($data);


           }



    public function store(Request $request){


        if (is_null($this->user) || !$this->user->can('therapyAppointmentAdd')) {
            abort(403, 'Sorry !! You are Unauthorized to Add !');
        }

        $request->validate([
            'patient_id' => 'required',
            'ingridient_name.*' => 'required',
            'therapy_id.*' => 'required',
            'ingridient_amount.*' => 'required',
            'therapist.*' => 'required',
            'therapy.*' => 'required',
            'date.*' => 'required',
            'start_time.*' => 'required',
            'end_time.*' => 'required',

        ]);

        //dd($request->all());
        $patientId = PatientHistory::where('id',$request->patient_id)->value('patient_id');


       $patientHistoryUpdate = PatientHistory::find($request->patient_id);
       $patientHistoryUpdate->status = 1;
       $patientHistoryUpdate->save();


        $therapyAppointment = new TherapyAppointment();
        $therapyAppointment->admin_id =Auth::guard('admin')->user()->id;
        $therapyAppointment->patient_id =$patientId;
        $therapyAppointment->save();

        $therapyAppointmentId = $therapyAppointment->id;

        $inputAllData = $request->all();

        $therapyAppointmentDetail = $inputAllData['therapy_id'];
        $therapistList = $inputAllData['therapist'];
       // TherapyAppointmentDateAndTime

        foreach($therapyAppointmentDetail as $key => $therapyAppointmentDetail){
            $therapyAppointmentDetail = new TherapyAppointmentDetail();
            $therapyAppointmentDetail->therapy_name=$inputAllData['therapy_id'][$key];
            $therapyAppointmentDetail->name=$inputAllData['ingridient_name'][$key];
            $therapyAppointmentDetail->amount=$inputAllData['ingridient_amount'][$key];
            $therapyAppointmentDetail->therapy_appointment_id   = $therapyAppointmentId;
            $therapyAppointmentDetail->save();

           }


           foreach($therapistList as $key => $therapistList){

            $getSerialValue =  TherapyAppointmentDateAndTime::where('therapist',$inputAllData['therapist'][$key])
            ->where('therapy',$inputAllData['therapy'][$key])
            ->where('date',$inputAllData['date'][$key])
            ->value('serial');

            if(empty($getSerialValue)){


             $finalSerialValue = 1;

            }else{
             $finalSerialValue = $getSerialValue + 1;

            }

            $therapistList = new TherapyAppointmentDateAndTime();
            $therapistList->therapist=$inputAllData['therapist'][$key];
            $therapistList->therapy=$inputAllData['therapy'][$key];
            $therapistList->date=$inputAllData['date'][$key];
            $therapistList->start_time=$inputAllData['start_time'][$key];
            $therapistList->end_time=$inputAllData['end_time'][$key];
            $therapistList->serial=$finalSerialValue;
            $therapistList->patient_id   = $patientId;
            $therapistList->admin_id   = Auth::guard('admin')->user()->id;
            $therapistList->therapy_appointment_id   = $therapyAppointmentId;
            $therapistList->save();

           }

           return redirect()->route('therapyAppointments.index')->with('success','Added successfully!');



    }

    public function destroy($id)
    {

        if (is_null($this->user) || !$this->user->can('therapyAppointmentDelete')) {
            abort(403, 'Sorry !! You are Unauthorized to Delete !');
        }


        TherapyAppointmentDateAndTime::destroy($id);
        return redirect()->route('therapyAppointments.index')->with('error','Deleted successfully!');
    }


    public function edit($id)
    {

        if (is_null($this->user) || !$this->user->can('therapyAppointmentUpdate')) {
            abort(403, 'Sorry !! You are Unauthorized to Edit !');
        }


        $therapyAppointmentDateAndTimeList = TherapyAppointmentDateAndTime::find($id);

        return view('backend.therapyAppointment.edit',compact('therapyAppointmentDateAndTimeList'));
    }
}

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
class WalkByPatientTherapyController extends Controller
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
        if (is_null($this->user) || !$this->user->can('walkByPatientTherapyView')) {
                   abort(403, 'Sorry !! You are Unauthorized to Add !');
               }
               $therapyAppointmentDateAndTimeList = TherapyAppointmentDateAndTime::where('date',date('Y-m-d'))->latest()->get();
       //dd(1);
               return view('backend.walkByPatientTherapy.index',compact('therapyAppointmentDateAndTimeList'));
           }



    public function create(){
        if (is_null($this->user) || !$this->user->can('walkByPatientTherapyAdd')) {
                   abort(403, 'Sorry !! You are Unauthorized to Add !');
               }
               $patientHistory = WalkByPatient::latest()->get();
       //dd(1);
               return view('backend.walkByPatientTherapy.create',compact('patientHistory'));
           }


           public function walkByPatientTherapyMain(Request $request){

            $therapistList = Therapist::latest()->get();

            $totalId = $request->numberOfChecked_length;
            $nameList = $request->numberOfSubChecked;

            $data = view('backend.walkByPatientTherapy.walkByPatientTherapyMain',compact('totalId','therapistList','nameList'))->render();
            return response()->json($data);
           }



           public function store(Request $request){


            if (is_null($this->user) || !$this->user->can('walkByPatientTherapyAdd')) {
                abort(403, 'Sorry !! You are Unauthorized to Add !');
            }


          // dd($request->all());
            // $request->validate([
            //     'patient_id' => 'required',
            //     'ingridient_name.*' => 'required',
            //     'therapy_id.*' => 'required',
            //     'ingridient_amount.*' => 'required',
            //     'therapist.*' => 'required',
            //     'therapy.*' => 'required',
            //     'date.*' => 'required',
            //     'start_time.*' => 'required',
            //     'end_time.*' => 'required',

            // ]);

            //dd($request->all());
            $patientId = WalkByPatient::where('id',$request->patient_id)->value('patient_reg_id');


           $patientHistoryUpdate = new PatientHistory();
           $patientHistoryUpdate->admin_id =Auth::guard('admin')->user()->id;
           $patientHistoryUpdate->patient_id =$patientId;
           $patientHistoryUpdate->status = 2;
           $patientHistoryUpdate->save();

           $patientHistoryUpdateId = $patientHistoryUpdate->id;


            $therapyAppointment = new TherapyAppointment();
            $therapyAppointment->admin_id =Auth::guard('admin')->user()->id;
            $therapyAppointment->patient_id =$patientId;
            $therapyAppointment->save();

            $therapyAppointmentId = $therapyAppointment->id;

            $inputAllData = $request->all();

            $therapyAppointmentDetail = $inputAllData['therapy_id'];
            $therapistList = $inputAllData['therapist'];
            $therapyNameDetail = $inputAllData['therapy_name'];
           // TherapyAppointmentDateAndTime

            foreach($therapyAppointmentDetail as $key => $therapyAppointmentDetail){
                $therapyAppointmentDetail = new TherapyAppointmentDetail();
                $therapyAppointmentDetail->therapy_name=$inputAllData['therapy_id'][$key];
                $therapyAppointmentDetail->name=$inputAllData['ingridient_name'][$key];
                $therapyAppointmentDetail->amount=$inputAllData['ingridient_amount'][$key];
                $therapyAppointmentDetail->therapy_appointment_id   = $therapyAppointmentId;
                $therapyAppointmentDetail->save();

               }

               foreach($therapyNameDetail as $key => $therapyNameDetail){


                $therapyName = new PatientTherapy();
                $therapyName->name=$inputAllData['therapy_name'][$key];
                $therapyName->amount=1;
                //$therapyName->doctor_id    =Auth::guard('admin')->user()->id;
                //$therapyName->doctor_appointment_id    =$therapyAppointmentId;
                $therapyName->patient_history_id   = $patientHistoryUpdateId;
                $therapyName->patient_id   = $patientId;
                $therapyName->save();

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

               return redirect()->route('walkByPatientTherapy.index')->with('success','Added successfully!');



        }


        public function destroy($id)
        {

            if (is_null($this->user) || !$this->user->can('walkByPatientTherapyDelete')) {
                abort(403, 'Sorry !! You are Unauthorized to Delete !');
            }


            TherapyAppointmentDateAndTime::destroy($id);
            return redirect()->route('therapyAppointments.index')->with('error','Deleted successfully!');
        }
}

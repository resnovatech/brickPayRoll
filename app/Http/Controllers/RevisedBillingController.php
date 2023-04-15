<?php

namespace App\Http\Controllers;

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
use App\Models\Payment;
use PDF;
class RevisedBillingController extends Controller
{
    public function index(){

        $patientHistory = PatientHistory::where('bill_status','=',1)->latest()->get();

        return view('backend.revisedBill.index',compact('patientHistory'));
    }

    public function show($id){
        $mainId = $id;
        $patientHistory = PatientHistory::find($id);
        $patientTherapyList =  PatientTherapy::where('patient_history_id',$id)->latest()->get();

$totalTherapyAmount = 0 ;
///new code
foreach($patientTherapyList as $allPatientTherapyList){


    $getTherapyPrice = TherapyList::where('name',$allPatientTherapyList->name)->value('amount');

    $totalTherapyAmount = $totalTherapyAmount + ($allPatientTherapyList->amount*$getTherapyPrice);


}


///end new code



        $patientHerb = PatientHerb::where('patient_history_id',$id)->latest()->get();


        $totalMedicineAmount = 0 ;
        ///new code
        foreach($patientHerb as $allPatientHerbList){


            $getPatientHerb = Medicine::where('name',$allPatientHerbList->name)->value('amount');



            $totalMedicineAmount = $totalMedicineAmount + ($getPatientHerb*$allPatientHerbList->how_many_dose);


        }

        //dd($totalMedicineAmount);
        ///end new code



        $patientMedicalSupplement = PatientMedicalSupplement::where('patient_history_id',$id)->latest()->get();


        $totalPatientMedicalSupplementAmount = 0 ;
        ///new code
        foreach($patientMedicalSupplement as $allPatientMedicalSupplement){


            $getPatientMedicalSupplement = HealthSupplement::where('name',$allPatientMedicalSupplement->name)->value('amount');

            $totalPatientMedicalSupplementAmount = $totalPatientMedicalSupplementAmount + ($getPatientMedicalSupplement*$allPatientMedicalSupplement->quantity);


        }


        ///end new code

        $getPhoneFromWalkByPatient = DB::table('walk_by_patients')
                                      ->where('patient_reg_id',$patientHistory->patient_id)->value('address');
        $getPhoneFromPatient = DB::table('patients')
                                      ->where('patient_id',$patientHistory->patient_id)->value('address');

                                      $getNameFromWalkByPatient = DB::table('walk_by_patients')
                                      ->where('patient_reg_id',$patientHistory->patient_id)->value('name');
                                      $getNameFromPatient = DB::table('patients')
                                      ->where('patient_id',$patientHistory->patient_id)->value('name');

                                      $getAllPaymentHistoryAmount = Payment::where('bill_id_new',$patientHistory->id)->sum('payment_amount');
                                     $getAllPaymentHistory = Payment::where('bill_id_new',$patientHistory->id)->latest()->get();

        return view('backend.revisedBill.show',compact('getAllPaymentHistoryAmount','getAllPaymentHistory','getNameFromPatient','getNameFromWalkByPatient','totalPatientMedicalSupplementAmount','totalMedicineAmount','totalTherapyAmount','getPhoneFromPatient','getPhoneFromWalkByPatient','patientHistory','mainId','patientTherapyList','patientHerb','patientMedicalSupplement'));

    }


    public function store(Request $request){

        //dd($request->all());

        $inputAllData = $request->all();

         $therapyName = $inputAllData['therapy_id'];
         $medicineName = $inputAllData['herb_id'];
         $supplimentName = $inputAllData['suppliment_id'];


         foreach($supplimentName as $key => $supplimentName){
            $supplimentName = PatientMedicalSupplement::find($inputAllData['suppliment_id'][$key]);
            $supplimentName->quantity=$inputAllData['suppliment_amount'][$key];
            $supplimentName->save();

           }




           foreach($therapyName as $key => $therapyName){
            $therapyName = PatientTherapy::find($inputAllData['therapy_id'][$key]);
            $therapyName->amount=$inputAllData['therapy_amount'][$key];
            $therapyName->save();

           }


           foreach($medicineName as $key => $medicineName){
            $medicineName = PatientHerb::find($inputAllData['herb_id'][$key]);
            $medicineName->how_many_dose=$inputAllData['herb_amount'][$key];
            $medicineName->save();

           }

           return redirect()->route('revisedBillings.index')->with('success','Updated');
    }
}

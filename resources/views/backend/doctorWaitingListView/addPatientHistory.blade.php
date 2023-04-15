@extends('backend.master.master')
@section('title')
DOCTOR PRESCRIPTION | {{ $ins_name }}
@endsection


@section('css')

@endsection

@section('body')
<div class="page-content">
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0">Doctor Prescription</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Forms</a></li>
                            <li class="breadcrumb-item active">Doctor Prescription Create</li>
                        </ol>
                    </div>

                </div>
            </div>
        </div>
        <!-- end page title -->
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header align-items-center d-flex">
                        <h4 class="card-title mb-0 flex-grow-1">Basic Information</h4>
                    </div><!-- end card header -->
                    <div class="card-body">
                        <div class="live-preview">
                            <div class="row gy-4">
                                {{-- <div class="col-xxl-6 col-md-6">
                                    <div>
                                        <label for="" class="form-label">Patient ID</label>
                                        <input type="text" class="form-control" id="" placeholder="Patient ID">
                                    </div>
                                </div> --}}
                                <div class="col-lg-12">
                                    <div class="card">
                                        <div class="card-header align-items-center d-flex">
                                            {{-- <h4 class="card-title mb-0 flex-grow-1">Patient Information</h4> --}}
                                        </div><!-- end card header -->

                                        <div class="card-body">
                                            <div class="live-preview">
                                                <div class="row g-3">
                                                    <div class="col-xxl-4">
                                                        <div class="card ribbon-box border shadow-none mb-lg-0">
                                                            <div class="card-body">
                                                                <div class="ribbon ribbon-primary round-shape">
                                                                    {{ $patientType }}
                                                                </div>

                                                                <div class="ribbon-content mt-4 text-muted">

                                                                    <p>Date : {{ $doctorWaitingList->appointment_date }}</p>
                                                                    <p>Name : {{ $patientList->name }}</p>
                                                                    <p>Age: {{ $patientList->age }}</p>
                                                                    <p>Address : {{ $patientList->address }}</p>

                                                                    <p>Contact No : {{ $patientList->phone_or_mobile_number }}</p>
                                                                    <p>Email ID : {{ $patientList->email_address }}</p>
                                                                    <p>Consulting Doctor : {{ $doctorWaitingList->doctor->name }}</p>

                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- end row -->
                                            </div>

                                        </div><!-- end card-body -->
                                    </div><!-- end card -->
                                </div>

                                <form action="{{ route('postPatientHistory') }}" method="post" enctype="multipart/form-data" id="form" data-parsley-validate="">
                                    @csrf
                                    <input type="hidden" name="admin_id" value="{{ $doctorWaitingList->admin_id }}" class="form-control" r>
                                    <input type="hidden" name="doctor_id" value="{{ $doctorWaitingList->doctor_id }}" class="form-control" r>
                                    <input type="hidden" name="doctor_appointment_id" value="{{ $doctorWaitingList->id }}" class="form-control" r>
                                    <input type="hidden" name="patient_id" value="{{ $doctorWaitingList->patient_id }}" class="form-control" r>

                                    <div class="row gy-4">
                                        <div class="col-xxl-12 col-md-6">
                                            <div>
                                                <label for="" class="form-label">Pradhan Vedana </label>
                                                <textarea name="pradhan_vedana" id="" class="form-control" cols="20" rows="3" r></textarea>
                                            </div>
                                        </div>
                                        <div class="col-xxl-12 col-md-6">
                                            <div>
                                                <label for="" class="form-label">Vedana Vrutanta </label>
                                                <textarea name="vedana_vrutanta" id="" class="form-control" cols="20" rows="3"r></textarea>
                                            </div>
                                        </div>
                                        <div class="col-xxl-12 col-md-6">
                                            <div>
                                                <label for="" class="form-label">Chikitsa Vrutanta </label>
                                                <textarea name="chikitsa_vrutanta" id="" class="form-control" cols="20" rows="3"r></textarea>
                                            </div>
                                        </div>
                                        <div class="col-xxl-12 col-md-6">
                                            <div>
                                                <label for="" class="form-label">Stri evam Prasooti Vrutant:</label>
                                                <textarea name="stri_evam_prasooti_vrutant" id="" class="form-control" cols="20" rows="3"r></textarea>
                                            </div>
                                        </div>
                                        <div class="col-xxl-12 col-md-6">
                                            <div>
                                                <label for="" class="form-label">LMP</label>
                                                <textarea name="lmp" id="" class="form-control" cols="20" rows="3"r></textarea>
                                            </div>
                                        </div>
                                        <div class="col-xxl-12 col-md-6">
                                            <div>
                                                <label for="" class="form-label">Poorva Vedana Vrutant:</label>
                                                <textarea name="poorva_vedana_vrutant" id="" class="form-control" cols="20" rows="3"r></textarea>
                                            </div>
                                        </div>
                                        <div class="col-xxl-12 col-md-6">
                                            <div>
                                                <label for="" class="form-label">Anuvanshika Vritanta:</label>
                                                <textarea name="anuvanshika_vritanta" id="" class="form-control" cols="20" rows="3"r></textarea>
                                            </div>
                                        </div>
                                        <div class="col-xxl-12 col-md-6">
                                            <div>
                                                <label for="" class="form-label">Pratyaksh Pramanam:</label>
                                                <textarea name="pratyaksh_pramanam" id="" class="form-control" cols="20" rows="3"r></textarea>
                                            </div>
                                        </div>
                                        <div class="col-xxl-12 col-md-6">
                                            <div>
                                                <label for="" class="form-label">Roga Preeksha – Srotas Pareeksha:</label>
                                                <textarea name="roga_preeksha_srotas_pareeksha" id="" class="form-control" cols="20" rows="3"r></textarea>
                                            </div>
                                        </div>
                                        <div class="col-xxl-12 col-md-6">
                                            <div>
                                                <label for="" class="form-label">Rasavaha Srotas: </label>
                                                <textarea name="rasavaha_srotas" id="" class="form-control" cols="20" rows="3"r></textarea>
                                            </div>
                                        </div>
                                        <div class="col-xxl-12 col-md-6">
                                            <div>
                                                <label for="" class="form-label">Raktavaha Srotas:</label>
                                                <textarea name="raktavaha_srotas" id="" class="form-control" cols="20" rows="3"r></textarea>
                                            </div>
                                        </div>
                                        <div class="col-xxl-12 col-md-6">
                                            <div>
                                                <label for="" class="form-label">Mamsavaha Srotas:</label>
                                                <textarea name="mamsavaha_srotas" id="" class="form-control" cols="20" rows="3"r></textarea>
                                            </div>
                                        </div>
                                        <div class="col-xxl-12 col-md-6">
                                            <div>
                                                <label for="" class="form-label">Medovaha Srotas:</label>
                                                <textarea name="medovaha_srotas" id="" class="form-control" cols="20" rows="3"r></textarea>
                                            </div>
                                        </div>
                                        <div class="col-xxl-12 col-md-6">
                                            <div>
                                                <label for="" class="form-label">Asthivaha Srotas:</label>
                                                <textarea name="asthivaha_srotas" id="" class="form-control" cols="20" rows="3"r></textarea>
                                            </div>
                                        </div>
                                        <div class="col-xxl-12 col-md-6">
                                            <div>
                                                <label for="" class="form-label">Majjavaha Srotas:</label>
                                                <textarea name="majjavaha_srotas" id="" class="form-control" cols="20" rows="3"r></textarea>
                                            </div>
                                        </div>
                                        <div class="col-xxl-12 col-md-6">
                                            <div>
                                                <label for="" class="form-label">Shukravaha Srotas: </label>
                                                <textarea name="shukravaha_srotas" id="" class="form-control" cols="20" rows="3"r></textarea>
                                            </div>
                                        </div>
                                        <div class="col-xxl-12 col-md-6">
                                            <div>
                                                <label for="" class="form-label">Rogi Pareeksha:</label>
                                                <textarea name="rogi_pareeksha" id="" class="form-control" cols="20" rows="3"r></textarea>
                                            </div>
                                        </div>
                                        <div class="col-xxl-12 col-md-6">
                                            <div>
                                                <label for="" class="form-label">Nadi:</label>
                                                <textarea name="nadi" id="" class="form-control" cols="20" rows="3"r></textarea>
                                            </div>
                                        </div>
                                        <div class="col-xxl-4 col-md-6">
                                            <div>
                                                <label for="" class="form-label">Dosha:</label>
                                                <input type="text" name="dosha" class="form-control" r>
                                            </div>
                                        </div>
                                        <div class="col-xxl-4 col-md-6">
                                            <div>
                                                <label for="" class="form-label">Dushya:</label>
                                                <input type="text" name="dushya" class="form-control" r>
                                            </div>
                                        </div>
                                        <div class="col-xxl-4 col-md-6">
                                            <div>
                                                <label for="" class="form-label">Shwas:</label>
                                                <input type="text" name="shwas" class="form-control" r>
                                            </div>
                                        </div>
                                        <div class="col-xxl-4 col-md-6">
                                            <div>
                                                <label for="" class="form-label">Tap(Temp.):</label>
                                                <input type="text" name="tap_temp" class="form-control" r>
                                            </div>
                                        </div>
                                        <div class="col-xxl-4 col-md-6">
                                            <div>
                                                <label for="" class="form-label">Kala:</label>
                                                <input type="text" name="kala" class="form-control" r>
                                            </div>
                                        </div>
                                        <div class="col-xxl-4 col-md-6">
                                            <div>
                                                <label for="" class="form-label">Bhara(Wt.):</label>
                                                <input type="text" name="bhara_wt" class="form-control" r>
                                            </div>
                                        </div>
                                        <div class="col-xxl-4 col-md-6">
                                            <div>
                                                <label for="" class="form-label">Agni:</label>
                                                <input type="text" name="agni" class="form-control" r>
                                            </div>
                                        </div>
                                        <div class="col-xxl-4 col-md-6">
                                            <div>
                                                <label for="" class="form-label">Raktchap(BP):</label>
                                                <input type="text" name="raktchap_bp" class="form-control" r>
                                            </div>
                                        </div>
                                        <div class="col-xxl-4 col-md-6">
                                            <div>
                                                <label for="" class="form-label">Prakruti:</label>
                                                <input type="text" name="prakruti" class="form-control" r>
                                            </div>
                                        </div>
                                        <div class="col-xxl-4 col-md-6">
                                            <div>
                                                <label for="" class="form-label">Mala:</label>
                                                <input type="text" name="mala" class="form-control" r>
                                            </div>
                                        </div>
                                        <div class="col-xxl-4 col-md-6">
                                            <div>
                                                <label for="" class="form-label">Vaya:</label>
                                                <input type="text" name="vaya" class="form-control" r>
                                            </div>
                                        </div>
                                        <div class="col-xxl-4 col-md-6">
                                            <div>
                                                <label for="" class="form-label">Mootra:</label>
                                                <input type="text" name="mootra" class="form-control" r>
                                            </div>
                                        </div>
                                        <div class="col-xxl-4 col-md-6">
                                            <div>
                                                <label for="" class="form-label">Satmya:</label>
                                                <input type="text" name="satmya" class="form-control" r>
                                            </div>
                                        </div>
                                        <div class="col-xxl-4 col-md-6">
                                            <div>
                                                <label for="" class="form-label">Kshudha:</label>
                                                <input type="text" name="kshudha" class="form-control" r>
                                            </div>
                                        </div>
                                        <div class="col-xxl-4 col-md-6">
                                            <div>
                                                <label for="" class="form-label">Satva:</label>
                                                <input type="text" name="satva" class="form-control" r>
                                            </div>
                                        </div>
                                        <div class="col-xxl-4 col-md-6">
                                            <div>
                                                <label for="" class="form-label">Nidra:</label>
                                                <input type="text" name="nidra" class="form-control" r>
                                            </div>
                                        </div>
                                        <div class="col-xxl-4 col-md-6">
                                            <div>
                                                <label for="" class="form-label">Ahara:</label>
                                                <input type="text" name="ahara" class="form-control" r>
                                            </div>
                                        </div>
                                        <div class="col-xxl-4 col-md-6">
                                            <div>
                                                <label for="" class="form-label">Vyasan:</label>
                                                <input type="text" name="vyasan" class="form-control" r>
                                            </div>
                                        </div>
                                        <div class="col-xxl-4 col-md-6">
                                            <div>
                                                <label for="" class="form-label">Roga Mrag:</label>
                                                <input type="text" name="roga_mrag" class="form-control" r>
                                            </div>
                                        </div>
                                        <div class="col-xxl-4 col-md-6">
                                            <div>
                                                <label for="" class="form-label">Rago Sthana:</label>
                                                <input type="text" name="rago_sthana" class="form-control" r>
                                            </div>
                                        </div>
                                        <div class="col-xxl-12 col-md-6">
                                            <div>
                                                <label for="" class="form-label">Sadhyasadhyata:</label>
                                                <textarea name="sadhyasadhyata" id="" class="form-control" cols="20" rows="3"r></textarea>
                                            </div>
                                        </div>
                                        <div class="col-xxl-12 col-md-6">
                                            <div>
                                                <label for="" class="form-label">Pathya:</label>
                                                <textarea name="pathya" id="" class="form-control" cols="20" rows="3"r></textarea>
                                            </div>
                                        </div>
                                        <div class="col-xxl-12 col-md-6">
                                            <div>
                                                <label for="" class="form-label">Yoga Chikitsa:</label>
                                                <textarea name="yoga_chikitsa" id="" class="form-control" cols="20" rows="3"r></textarea>
                                            </div>
                                        </div>
                                        <div class="col-xxl-12 col-md-6">
                                            <div>
                                                <label for="" class="form-label">Paramarsh:</label>
                                                <textarea name="paramarsh" id="" class="form-control" cols="20" rows="3"r></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="text-end mb-3 mt-5">
                                    <button type="submit" class="btn btn-primary w-sm">Submit
                                    </button>
                                </div>
</form>
                                <!--end col-->
                            </div>
                            <!--end row-->
                        </div>
                    </div>
                </div>
            </div>
            <!--end col-->
        </div>
        <!--end row-->
    </div>





</div>
@endsection


@section('script')

@endsection

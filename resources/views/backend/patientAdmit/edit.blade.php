@extends('backend.master.master')

@section('title')
Update  Patient | {{ $ins_name }}
@endsection


@section('body')
<div class="page-content">
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0">Admit Patient Information</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Forms</a></li>
                            <li class="breadcrumb-item active">Update Admit Patient</li>
                        </ol>
                    </div>

                </div>
            </div>
        </div>
        <!-- end page title -->
        <form action="{{ route('patientAdmits.update',$patientAdmitList->id) }}" method="post" enctype="multipart/form-data" id="form" data-parsley-validate="">
            @csrf
            @method('PUT')
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header align-items-center d-flex">
                        <h4 class="card-title mb-0 flex-grow-1">Basic Information</h4>
                        @include('flash_message')
                    </div><!-- end card header -->
                    <div class="card-body">
                        <div class="live-preview">
                            <div class="row gy-4">
                                <div class="col-xxl-6 col-md-6">
                                    <div>
                                        <label for="" class="form-label">Patient</label>
                                        <select class="form-control" name="patient_type" id="patientType" required>
                                            <option value="New" {{ $patientAdmitList->patient_type == 'New' ? 'selected':'' }}>New</option>
                                            <option value="Already Registered" {{ $patientAdmitList->patient_type == 'Already Registered' ? 'selected':'' }}>Already Registered</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-xxl-6 col-md-6">
                                    <div id="forNewPatient">
                                        <label for="" class="form-label">Patient ID</label>
                                        <input type="number" class="form-control" name="patient_id_new" id="" value="<?php echo date('dmy').time(); ?>" >
                                    </div>

                                    <div id="forOldPatient">
                                        <label for="" class="form-label">Patient ID</label>
                                        <select class="form-control" name="patient_id_old" id="patient_id_old">
                                            <option >--Please Select-----</option>
                                            @foreach($patientList as $allPatientList)
<option value="{{ $allPatientList->patient_id }}" data-name="{{ $allPatientList->name }}"
    data-age="{{ $allPatientList->age }}"
    data-gender="{{ $allPatientList->gender }}"
    data-address="{{ $allPatientList->address }}"
    data-emailaddress="{{ $allPatientList->email_address }}"
    data-phonenumber="{{ $allPatientList->phone_or_mobile_number }}"
    data-nidnumber="{{ $allPatientList->nid_number }}"
    data-nationality="{{ $allPatientList->nationality }}"  {{ $allPatientList->patient_id == $patientAdmitList->patient_id  ? 'selected':'' }}>
    {{ $allPatientList->patient_id }}</option>
                                         @endforeach
                                        </select>
                                    </div>

                                </div>
                                <div class="col-xxl-6 col-md-6">
                                    <div>
                                        <label for="" class="form-label">Name</label>
                                        <input type="text" class="form-control" name="name" id="name" value="{{ $patientAdmitList->name  }}" placeholder="Name" required>
                                    </div>
                                </div>
                                <div class="col-xxl-6 col-md-6">
                                    <div>
                                        <label for="" class="form-label">Age</label>
                                        <input type="text" class="form-control" id="age" name="age" value="{{ $patientAdmitList->age  }}" placeholder="Age" required>
                                    </div>
                                </div>
                                <div class="col-xxl-6 col-md-6">
                                    <div>
                                        <label for="" class="form-label">Gender</label>
                                        <select class="form-control" name="gender" id="gender" required>
                                            <option value="Male" {{ $patientAdmitList->gender =='Male' ? 'selected':'' }}>Male</option>
                                            <option value="Female" {{ $patientAdmitList->gender == 'Female' ? 'selected':'' }}>Female</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-xxl-6 col-md-6">
                                    <div>
                                        <label for="" class="form-label">Address</label>
                                        <input type="text" class="form-control" id="address" value="{{ $patientAdmitList->address  }}"  name="address" placeholder="Address" required>
                                    </div>
                                </div>
                                <div class="col-xxl-6 col-md-6">
                                    <div>
                                        <label for="" class="form-label">Email Address</label>
                                        <input type="email" class="form-control" id="email_address" value="{{ $patientAdmitList->email_address  }}"  name="email_address"
                                               placeholder="Email Address" required>
                                    </div>
                                </div>
                                <div class="col-xxl-6 col-md-6">
                                    <div>
                                        <label for="" class="form-label">Phone/Mobile Number</label>
                                        <input type="text" class="form-control" id="phone_or_mobile_number" value="{{ $patientAdmitList->phone_or_mobile_number }}"   name="phone_or_mobile_number"
                                               placeholder="Phone Number" required>
                                    </div>
                                </div>
                                <div class="col-xxl-6 col-md-6">
                                    <div>
                                        <label for="" class="form-label">National ID Number</label>
                                        <input type="text" class="form-control" id="nid_number" value="{{ $patientAdmitList->nid_number }}"
                                               placeholder="National ID Number" name ="nid_number" required>
                                    </div>
                                </div>
                                <div class="col-xxl-6 col-md-6">
                                    <div>
                                        <label for="" class="form-label">Nationality</label>
                                        <input type="text" class="form-control" id="nationality" value="{{ $patientAdmitList->nationality }}" name="nationality" placeholder="Nationality" required>
                                    </div>
                                </div>

                                <div class="col-xxl-12 col-md-12">
                                    <div>
                                        <label for="" class="form-label">Type of accommodation</label>
                                        <textarea class="form-control" id="" name="type_of_accommodation" rows="3"
                                                  style="height: 101px;" required>{{ $patientAdmitList->type_of_accommodation }}</textarea>
                                    </div>
                                </div>
                                <div class="col-xxl-12 col-md-12">
                                    <div>
                                        <label for="" class="form-label">Recommended doctor name  </label>
                                        <select class="js-example-basic-single form-control" name="doctor_id" required>
                                            <option>--Please Select --</option>
                                            @foreach($doctorList as $allDoctorList)
                                            <option value="{{ $allDoctorList->id }}" {{ $allDoctorList->id == $patientAdmitList->doctor_id ? 'selected':''}}>{{ $allDoctorList->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-12" style="margin-bottom: -20px !important;">
                                    <h6 class="fs-14 text-muted">Duration of stay</h6>
                                </div>
                                <div class="col-xxl-6 col-md-6">
                                    <div>
                                        <label for="" class="form-label">Start Date</label>
                                        <input type="date" class="form-control" id="" name="start_date" value="{{ $patientAdmitList->start_date }}" placeholder="Start Date" required>
                                    </div>
                                </div>
                                <div class="col-xxl-6 col-md-6">
                                    <div>
                                        <label for="" class="form-label">End Date</label>
                                        <input type="date" class="form-control" id="" name="end_date" value="{{ $patientAdmitList->end_date }}"  placeholder="End Date" required>
                                    </div>
                                </div>

                                <?php
                                $treatmentPackageName = explode(",",$patientAdmitList->treatment_package_name);

                                                   ?>


                                <div class="col-xxl-12 col-md-12">
                                    <div>
                                        <label for="" class="form-label">Treatment package name </label>
                                        <select class="js-example-basic-multiple" name="treatment_package_name[]" multiple="multiple" required>
                                            @foreach($therapyLists as $alltherapyLists)
                                            <option value="{{ $alltherapyLists->id }}" {{ (in_array($alltherapyLists->id,$treatmentPackageName)) ? 'selected' : '' }}>{{ $alltherapyLists->name }}</option>
                                            @endforeach

                                        </select>
                                    </div>
                                </div>
                                <div class="col-xxl-6 col-md-6">
                                    <div>
                                        <label for="" class="form-label">Routine</label>
                                        <input type="file" class="form-control" id="" name="routine" placeholder="doc" >
                                        <img src="{{ asset('/') }}{{ $patientAdmitList->routine }}" height="50px" />
                                    </div>
                                </div>

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

        <div class="text-end mb-3">
            <button type="submit" class="btn btn-primary w-sm" >Update</button>
        </div>
    </form>
    </div>

    <!-- End Page-content -->


@endsection

@section('script')
<script>
    $(document).ready(function () {
    $('#form').validate({ // initialize the plugin

    });

    //patient type code


    $(function() {
    $('#forNewPatient').hide();
    $('#patientType').change(function(){
        if($('#patientType').val() == 'Already Registered') {
            $('#forOldPatient').show();
            $('#forNewPatient').hide();
        } else {
            $('#forOldPatient').hide();
            $('#forNewPatient').show();
        }
    });
});





    //patient type code


    $(function(){
    $('#patient_id_old').change(function(){
       var selected = $(this).find('option:selected');
       var name = selected.data('name');
       var age = selected.data('age');
       var address = selected.data('address');
       var email_address = selected.data('emailaddress');
       var phone_or_mobile_number = selected.data('phonenumber');
       var nid_number = selected.data('nidnumber');
       var nationality = selected.data('nationality');

       var gender = selected.data('gender');




       $("#gender").val(gender).change();
       $('#name').val(name);
       $('#age').val(age);
       $('#address').val(address);
       $('#email_address').val(email_address);
       $('#phone_or_mobile_number').val(phone_or_mobile_number);
       $('#nid_number').val(nid_number);
       $('#nationality').val(nationality);


    });
});




});
</script>

@endsection

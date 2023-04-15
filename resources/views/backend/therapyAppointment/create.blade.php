@extends('backend.master.master')
@section('title')
Therapy Appointment | {{ $ins_name }}
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
                    <h4 class="mb-sm-0">Therapy Appointment</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Forms</a></li>
                            <li class="breadcrumb-item active">Therapy Appointment</li>
                        </ol>
                    </div>

                </div>
            </div>
        </div>

        <form action="{{ route('therapyAppointments.store') }}" method="post" enctype="multipart/form-data" id="form" data-parsley-validate="">
            @csrf
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
                                <div class="col-xxl-6 col-md-6">
                                    <div>
                                        <label for="" class="form-label">Patient ID</label>
                                        <select class="js-example-basic-single form-control" name="patient_id" id="patient_id" required>
                                        <option >--Please Select-----</option>


                                        @foreach($patientHistory as $allPatientHistory)
<option value="{{ $allPatientHistory->id }}" >{{ $allPatientHistory->patient_id }}</option>
                                     @endforeach
                                    </select>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="card">
                                        <div class="card-header align-items-center d-flex">
                                            <h4 class="card-title mb-0 flex-grow-1">Patient Information</h4>
                                        </div><!-- end card header -->

                                        <div class="card-body">
                                            <div class="live-preview">
                                                <div class="row g-3">
                                                    <div class="col-xxl-4">
                                                        <div class="card ribbon-box border shadow-none mb-lg-0">
                                                            <div class="card-body" id="mainDetailOne">


                                                                <div class="ribbon-content mt-4 text-muted">
                                                                    <p>Name</p>
                                                                    <p>Age</p>
                                                                    <p>Email Address</p>
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

        <div  id="mainDetail">


</div>
</form>

</div>
@endsection

@section('script')
<script>

    $('#patient_id').change(function(){

       var patient_id =$(this).val();
       //alert(patient_id);

       $.ajax({
            url: "{{ route('getTherapyAppointmentDetail') }}",
            method: 'GET',
            data: {patient_id:patient_id},
            success: function(data) {

              $("#mainDetailOne").html('');
              $("#mainDetailOne").html(data);
            }
        });

        $.ajax({
            url: "{{ route('getTherapyListDetail') }}",
            method: 'GET',
            data: {patient_id:patient_id},
            success: function(data) {

              $("#mainDetail").html('');
              $("#mainDetail").html(data);
            }
        });

});

    </script>
@endsection

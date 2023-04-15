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

        <form action="{{ route('walkByPatientTherapy.store') }}" method="post" enctype="multipart/form-data" id="form" data-parsley-validate="">
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
<option value="{{ $allPatientHistory->id }}" >{{ $allPatientHistory->patient_reg_id }}</option>
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

        <div class="row">
            <div class="col-lg-12">
                <a class="saveBtn btn btn-primary" style="">
                    <i class="fa fa-plus"> </i>Add Therapy
                </a>
            </div>
        </div>

        <div class="row">
            <?php
  $patientTherapyList = DB::table('therapy_lists')->latest()->get();

  $get_count = count($patientTherapyList);
                ?>

            @foreach($patientTherapyList as $key=>$allPatientTherapyList)
            <?php

        $therapyId = DB::table('therapy_lists')
                ->where('name', $allPatientTherapyList->name)->value('id');

        $therapyDetailList = DB::table('therapy_details')
                ->where('therapy_list_id', $therapyId)->get();
                $therapyName = DB::table('therapy_lists')
                ->where('id', $therapyId)->value('name');
            ?>



            @if(($key) == 0)
            <div class="col-lg-6 mt-2" style="display: block;">
                <div class="card">
                    <div class="card-header align-items-center d-flex">
                        <h4 class="card-title mb-0 flex-grow-1">Therapy Name:
                            {{ $therapyName }}
                        </h4>
                        <input type="checkbox" style="display: none" id="therapy_name{{$key}}" value="{{$allPatientTherapyList->name}}" name="therapy_name[]"
                        class="sub_chk" checked/>
                    </div><!-- end card header -->
                @else
                <div class="col-lg-6 mt-2" style="display: none" id="myDIV{{ $key }}">
                    <div class="card">
                        <div class="card-header align-items-center d-flex">
                            <input type="checkbox" style="display: none"  id="therapy_name{{$key}}" value="{{$allPatientTherapyList->name}}" name="therapy_name[]"
                            class="sub_chk"/>
                            <h4 class="card-title mb-0 flex-grow-1">Therapy Name: {{ $therapyName }}</h4>
                            <a class="btn btn-danger btn-sm" onclick="myFunction({{ $key }})" id="removeDiv{{ $key }}">Delete</a>
                        </div><!-- end card header -->
                @endif

                    <div class="card-body">
                        <p class="text-muted">Add Ingredient</p>

                            <table class="table table-bordered" id="dynamicAddRemove{{ $allPatientTherapyList->id }}">
                                <tr>
                                    <th>Name</th>
                                    <th>Amount</th>
                                    <th>Action</th>
                                </tr>
                                @foreach($therapyDetailList as $mainkey=>$allTherapyDetailList)

                                <?php

        $therapyDetailListName = DB::table('therapy_ingredients')
                ->where('id', $allTherapyDetailList->therapy_ingredient_id)->value('name');

            ?>


                                <tr>
                                    <td>
                                        <input type="text" value="{{$therapyDetailListName}}" name="ingridient_name[]"
                                               class="form-control" required/>

                                               <input type="hidden" value="{{$therapyId}}" name="therapy_id[]"
                                               class="form-control therapy_id"/>









                                    </td>
                                    <td>
                                        <input type="text" value="{{ $allTherapyDetailList->quantity }}{{ $allTherapyDetailList->unit }}" name="ingridient_amount[]"
                                               class="form-control" required/>
                                    </td>

                                    <td>
                                        @if($mainkey+1 == 1)
                                        <button type="button" name="add" id="dynamic-ar{{ $allPatientTherapyList->id }}"
                                                class="btn btn-outline-primary btn-sm">Add New Therapy
                                        </button>
                                        @else

                                        @endif
                                    </td>

                                </tr>
                                @endforeach
                            </table>


                        <!--end col-->
                    </div>
                </div>
            </div>
            @endforeach

        </div>

        <div class="row">
            <div class="col-lg-12">
                <a class="therapist btn btn-primary" style="">
                    <i class="fa fa-plus"> </i>Add Therapist
                </a>
            </div>
        </div>

        <div class="row mt-3" id="mainIdList">

        </div>
</form>

</div>
@endsection

@section('script')
<script>
    function myFunction(id) {
        //alert(id);
       const element = document.getElementById("myDIV"+id);
   element.remove();
    }
    </script>
<script>
    btns = document.getElementsByClassName("saveBtn");
btns[0].addEventListener('click', function() {

  for (var i = 0; i <= {{ $get_count - 1 }}; i++) {
    var id = 'myDIV' + i;
    var therapy_name = 'therapy_name' + i ;

    //alert(therapy_name);

    document.getElementById(therapy_name).checked = true;

    var element = document.getElementById(id);
    var setting = (element) ? element.style.display : '';

    if (setting == 'none') {
      element.style.display = 'block';
      document.getElementById(therapy_name).checked = true;
      break;
    }
  }
})
</script>




<script>
    $('.therapist').click(function(){




        var numberOfSubChecked = $('.sub_chk:checked').map(function (idx, ele) {
        return $(ele).val();
        }).get();




        var numberOfChecked_length = numberOfSubChecked.length;

       // alert(numberOfSubChecked);

        $.ajax({
            url: "{{ route('walkByPatientTherapyMain') }}",
            method: 'GET',
            data: {numberOfChecked_length:numberOfChecked_length,numberOfSubChecked:numberOfSubChecked},
            success: function(data) {

              $("#mainIdList").html('');
              $("#mainIdList").html(data);
            }
        });

    });
///

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



});

    </script>
    <script type="text/javascript">
        var i = 0;
        $("[id^=dynamic-ar]").click(function () {

            var main_id = $(this).attr('id');
                 var id_for_pass = main_id.slice(10);
            ++i;
            $("#dynamicAddRemove"+id_for_pass).append('<tr><td><input type="text"  name="ingridient_name[]"class="form-control" required/>  <input type="hidden" value="{{$therapyId}}" name="therapy_id[]"class="form-control"/></td><td><input type="text" value="" name="ingridient_amount[]"class="form-control" required/></td><td><button type="button" class="btn btn-outline-danger remove-input-field">Delete</button></td></tr>');
        });
        $(document).on('click', '.remove-input-field', function () {
            $(this).parents('tr').remove();
        });
    </script>
@endsection

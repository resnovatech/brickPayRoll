@extends('backend.master.master')

@section('title')
Create  Employee | {{ $ins_name }}
@endsection


@section('body')
<div class="page-content">
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0">Employee Information</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Forms</a></li>
                            <li class="breadcrumb-item active">Employee</li>
                        </ol>
                    </div>

                </div>
            </div>
        </div>
        <!-- end page title -->
        <form action="{{ route('employee.store') }}" method="post" enctype="multipart/form-data" id="form" data-parsley-validate="">
            @csrf
            <input type="hidden"  name ="admin_id" class="form-control" value="{{ Auth::guard('admin')->user()->id }}" required>
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
                                        <label for="" class="form-label">Employee ID</label>
                                        <input type="number" readonly class="form-control" name="employee_id" id="" value="<?php echo rand(1111111111,9999999999); ?>" >
                                    </div>



                                </div>
                                <div class="col-xxl-6 col-md-6">
                                    <div>
                                        <label for="" class="form-label">Name</label>
                                        <input type="text" class="form-control" name="name" id="name" maxlength="50" placeholder="Name" required>
                                    </div>
                                </div>
                                <div class="col-xxl-6 col-md-6">
                                    <div>
                                        <label for="" class="form-label">Mobile Number</label>
                                        <input type="number" class="form-control" id="mobile_number" name="mobile_number"
                                               placeholder="Mobile Number" required pattern="/^-?\d+\.?\d*$/" onKeyPress="if(this.value.length==11) return false;">
                                    </div>
                                </div>
                                <div class="col-xxl-6 col-md-6">
                                    <div>
                                        <label for="" class="form-label">Email Address</label>
                                        <input type="email" class="form-control" id="email" name="email" maxlength="50"
                                               placeholder="Email Address" required>
                                    </div>
                                </div>
                                <div class="col-xxl-6 col-md-6">
                                    <div>
                                        <label for="" class="form-label">Gender</label>
                                        <select class="form-control" name="gender" id="gender" required>
                                            <option value="Male">Male</option>
                                            <option value="Female">Female</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-xxl-6 col-md-6">
                                    <div>
                                        <label for="" class="form-label">Designation</label>
                                        <select class="form-control" name="designation_id" id="designation_id">
                                            <option >--Please Select-----</option>
                                            @foreach($designationLists as $allPatientList)
<option value="{{ $allPatientList->id }}" data-name="{{ $allPatientList->department->department_name }}">{{ $allPatientList->designation_name }}</option>
                                         @endforeach
                                        </select>
                                    </div>
                                </div>


                                <div class="col-xxl-6 col-md-6">
                                    <div>
                                        <label for="" class="form-label">Department Name</label>
                                        <input type="text" class="form-control" id="department"
                                               placeholder="Department Name" name ="department" required>
                                    </div>
                                </div>
                                <div class="col-xxl-6 col-md-6">
                                    <div>
                                        <label for="" class="form-label">Company Name</label>
                                        <select class="form-control" name="company_id" id="company_id">
                                            <option >--Please Select-----</option>
                                            @foreach($companyList as $allPatientList)
<option value="{{ $allPatientList->id }}">{{ $allPatientList->company_name }}</option>
                                         @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="col-xxl-12 col-md-12">
                                    <div>
                                        <label for="" class="form-label">Job Location</label>
                                        <textarea class="form-control" id="" name="job_location" rows="3"
                                                  style="height: 101px;" required></textarea>
                                    </div>
                                </div>
                                <div class="col-12 mb-2">
                                    <label for="" class="form-label">Status</label><br>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="status" id="inlineRadio1" value="Active" >
                                        <label class="form-check-label" for="inlineRadio1">Active</label>
                                      </div>
                                      <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="status" id="inlineRadio2" value="InActive" >
                                        <label class="form-check-label" for="inlineRadio2">InActive</label>
                                      </div>
                                </div>

                                <div class="col-xxl-12 col-md-12">
                                    <div>

                                        <label for="" class="form-label">Discontinue Date</label>
                                        <input type="text" class="form-control" id="datepicker" name="discontinue_date" placeholder="Discontinue Date" required>
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
            <button type="submit" class="btn btn-primary w-sm" >Submit</button>
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








    //patient type code


    $(function(){
    $('#designation_id').change(function(){
       var selected = $(this).find('option:selected');
       var name = selected.data('name');






       $('#department').val(name);



    });
});




});
</script>

@endsection

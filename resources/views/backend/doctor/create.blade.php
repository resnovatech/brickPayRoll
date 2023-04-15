@extends('backend.master.master')

@section('title')
Doctor List | {{ $ins_name }}
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
                    <h4 class="mb-sm-0">Doctor Information</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Forms</a></li>
                            <li class="breadcrumb-item active">Doctor</li>
                        </ol>
                    </div>

                </div>
            </div>
        </div>
        <!-- end page title -->
        <form action="{{ route('doctorStore') }}"  method="post" enctype="multipart/form-data" id="form" data-parsley-validate="">

            @csrf

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
                                        <label for="" class="form-label">Doctor name</label>
                                        <input type="text" class="form-control" id="" placeholder="Name" name="name" required>
                                    </div>
                                </div>
                                <div class="col-xxl-6 col-md-6">
                                    <div>
                                        <label for="" class="form-label">Address</label>
                                        <input type="text" class="form-control" id="" placeholder="Address" name="address" required>
                                    </div>
                                </div>
                                <div class="col-xxl-6 col-md-6">
                                    <div>
                                        <label for="" class="form-label">Gender</label>
                                        <select class="form-control" name="gender" id="" required>
                                            <option value="Male">Male</option>
                                            <option value="Female">Female</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-xxl-6 col-md-6">
                                    <div>
                                        <label for="" class="form-label">Email Address</label>
                                        <input type="email" class="form-control" id="" name="email_address" required
                                               placeholder="Email Address">
                                    </div>
                                </div>
                                <div class="col-xxl-6 col-md-6">
                                    <div>
                                        <label for="" class="form-label">Phone/Mobile Number</label>
                                        <input type="text" class="form-control" id="" name="phone_or_mobile_number" required
                                               placeholder="Phone Number">
                                    </div>
                                </div>
                                <div class="col-xxl-6 col-md-6">
                                    <div>
                                        <label for="" class="form-label">National ID Number</label>
                                        <input type="text" class="form-control" id=""
                                               placeholder="National ID Number" name="nid_number" required>
                                    </div>
                                </div>
                                <div class="col-xxl-6 col-md-6">
                                    <div>
                                        <label for="" class="form-label">Nationality</label>
                                        <input type="text" class="form-control" name="nationality" id="" placeholder="Nationality" required>
                                    </div>
                                </div>
                                <div class="col-xxl-6 col-md-6">
                                    <div>
                                        <label for="" class="form-label">Years Of Experience</label>
                                        <input type="text" class="form-control" name="years_of_experience" id="" placeholder="Years Of Experience" required>
                                    </div>
                                </div>
                                <div class="col-xxl-6 col-md-6">
                                    <div>
                                        <label for="" class="form-label">Doctor's Certificate</label>
                                        <input type="file" class="form-control" name="doctor_certificate" id="" placeholder="Years Of Experience" required>
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


        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header align-items-center d-flex">
                        <h4 class="card-title mb-0 flex-grow-1">Doctor Consult Date </h4>
                    </div><!-- end card header -->
                    <div class="card-body">


                            <table class="table table-bordered" id="dynamicAddRemove">
                                <tr>
                                    <th>Day</th>
                                    <th>Start Time</th>
                                    <th>End Time</th>
                                </tr>
                                <tr>
                                    <td>
                                        <select class="form-select mb-3" name="doctor_day[]" aria-label="Default select example" required>
                                            <option selected>Open this select menu</option>
                                            <option value="Saturday">Saturday</option>
                                            <option value="Sunday">Sunday</option>
                                            <option value="Monday">Monday</option>
                                            <option value="Tuesday">Tuesday</option>
                                            <option value="Wednesday">Wednesday</option>
                                            <option value="Thursday">Thursday</option>
                                            <option value="Friday">Friday</option>
                                        </select>
                                    </td>
                                    <td>
                                        <input type="time" name="start_time[]"
                                               class="form-control" required/>
                                    </td>
                                    <td>
                                        <input type="time" name="end_time[]" value=""
                                               class="form-control" required/>
                                    </td>
                                    <td>
                                        <button type="button" name="add" id="dynamic-ar"
                                                class="btn btn-outline-primary">Add New Date
                                        </button>
                                    </td>
                                </tr>
                            </table>

                    </div>
                </div>
            </div>
            <!--end col-->
        </div>

        <div class="text-end mb-3">
            <button type="submit" class="btn btn-primary w-sm" >Submit</button>
        </div>
    </form>

    </div>


@endsection


@section('script')

<script>
    $(document).ready(function () {
    $('#form').validate({ // initialize the plugin

    });
});
</script>

<script type="text/javascript">
    var i = 0;
    $("#dynamic-ar").click(function () {
        ++i;
        $("#dynamicAddRemove").append('<tr>' +
            '<td>' +
            ' <select class="form-select mb-3" name="doctor_day[]" aria-label="Default select example" required>' +
            '<option value="Saturday">Saturday</option><option value="Sunday">Sunday</option><option value="Monday">Monday</option><option value="Tuesday">Tuesday</option><option value="Wednesday">Wednesday</option><option value="Thursday">Thursday</option><option value="Friday">Friday</option></select>' +
            '</td>' +
            '<td>' +
            '<input type="time" name="start_time[]" class="form-control" required/></td>' +
            '<td>' +
            '<input type="time" name="end_time[]" class="form-control" required/></td>' +
            '<td><button type="button" class="btn btn-outline-danger remove-input-field">Delete</button></td></tr>'
        );
    });
    $(document).on('click', '.remove-input-field', function () {
        $(this).parents('tr').remove();
    });
</script>
@endsection

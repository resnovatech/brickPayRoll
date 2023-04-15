@extends('backend.master.master')

@section('title')
Create Walk By Patient | {{ $ins_name }}
@endsection


@section('body')
<div class="page-content">
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0">Walking Information</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Forms</a></li>
                            <li class="breadcrumb-item active">Walking Patient</li>
                        </ol>
                    </div>

                </div>
            </div>
        </div>
         <form action="{{ route('walkByPatients.store') }}" method="post" enctype="multipart/form-data" id="form" data-parsley-validate="">
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
                                        <label for="" class="form-label">Image</label>
                                        <input type="file" class="form-control" name="image" id="" placeholder="Name" required>
                                    </div>
                                </div>
                                <div class="col-xxl-6 col-md-6">
                                    <div>
                                        <label for="" class="form-label">Name</label>
                                        <input type="text" class="form-control" name="name" id="" placeholder="Name" required>
                                    </div>
                                </div>
                                <div class="col-xxl-6 col-md-6">
                                    <div>
                                        <label for="" class="form-label">Reffere From</label>
                                        <input type="text" class="form-control" name="refer_from" id="" placeholder="Name" required>
                                    </div>
                                </div>
                                <div class="col-xxl-6 col-md-6">
                                    <div>
                                        <label for="" class="form-label">Age</label>
                                        <input type="text" class="form-control" name="age" id="" placeholder="Age" required>
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
                                        <label for="" class="form-label">Address</label>
                                        <input type="text" class="form-control" id="" placeholder="Address" name="address" required>
                                    </div>
                                </div>
                                <div class="col-xxl-6 col-md-6">
                                    <div>
                                        <label for="" class="form-label">Email Address</label>
                                        <input type="email" class="form-control" id="" name="email_address"
                                               placeholder="Email Address" required>
                                    </div>
                                </div>
                                <div class="col-xxl-6 col-md-6">
                                    <div>
                                        <label for="" class="form-label">Phone/Mobile Number</label>
                                        <input type="text" class="form-control" id="" name="phone_or_mobile_number" maxlength="11"
                                               placeholder="Phone Number" required>
                                    </div>
                                </div>
                                <div class="col-xxl-6 col-md-6">
                                    <div>
                                        <label for="" class="form-label">National ID Number</label>
                                        <input type="text" class="form-control" id="" name="nid_number"
                                               placeholder="National ID Number" required>
                                    </div>
                                </div>
                                <div class="col-xxl-6 col-md-6">
                                    <div>
                                        <label for="" class="form-label">Nationality</label>
                                        <input type="text" class="form-control" name="nationality" id="" placeholder="Nationality" required>
                                    </div>
                                </div>
                                <div class="col-xxl-12 col-md-12">
                                    <div>
                                        <label for="" class="form-label">How did you come to know about this
                                            center</label>
                                        <textarea class="form-control" name="how_did_you_come_to_know_about_this_center" id="" rows="3"
                                                  style="height: 101px;" required></textarea>
                                    </div>
                                </div>
                                <div class="col-xxl-12 col-md-12">
                                    <div>
                                        <label for="" class="form-label">Do you have earlier experience of
                                            Ayurveda, please give details </label>
                                        <textarea class="form-control" name="do_you_have_earlier_experience_of_ayurveda_please_give_details" id="" rows="3"
                                                  style="height: 101px;" required></textarea>
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
                        <h4 class="card-title mb-0 flex-grow-1">Health Concern </h4>
                    </div><!-- end card header -->
                    <div class="card-body">


                            <table class="table table-bordered" id="dynamicAddRemove">
                                <tr>
                                    <th>Name</th>
                                    <th>Details</th>
                                </tr>
                                <tr>
                                    <td>
                                        <select class="form-select mb-3" name="disease_name[]" aria-label="Default select example" required>
                                            <option selected>Open this select menu</option>
                                            <option value="Chronic illness">Chronic illness</option>
                                            <option value="Hepatitis B positive">Hepatitis B positive</option>
                                            <option value="High blood pressure">High blood pressure</option>
                                            <option value="Diabetes">Diabetes</option>
                                            <option value="Recent surgery">Recent surgery</option>
                                        </select>
                                    </td>
                                    <td>
                                        <input type="text" name="detail[]" value=""
                                               class="form-control" required/>
                                    </td>
                                    <td>
                                        <button type="button" name="add" id="dynamic-ar"
                                                class="btn btn-outline-primary">Add New Service
                                        </button>
                                    </td>
                                </tr>
                            </table>

                    </div>
                </div>
            </div>
            <!--end col-->
        </div>

        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row gy-4">
                            <div class="col-xxl-12 col-md-12">
                                <div>
                                    <label for="" class="form-label">Did you have symptoms in past 1 weak (high fever, runny nose, cough, others)</label>
                                    <textarea class="form-control" id="" rows="3"
                                              style="height: 101px;" name="do_you_have_symptoms_in_past_one_weak" required></textarea>
                                </div>
                            </div>
                            <div class="col-xxl-12 col-md-12">
                                <div>
                                    <label for="" class="form-label">Have you undergone the covid 19 test?</label>
                                    <select class="form-control" name="covid_test_result" id="" required>
                                        <option value="Yes">Yes</option>
                                        <option value="No">No</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <button type="submit" class="btn btn-primary w-sm" >Submit</button>

    </form>

    </div>

    <!-- End Page-content -->

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
            ' <select class="form-select mb-3" name="disease_name[]" aria-label="Default select example" required>' +
            ' <option value="Chronic illness">Chronic illness</option><option value="Hepatitis B positive">Hepatitis B positive</option><option value="High blood pressure">High blood pressure</option><option value="Diabetes">Diabetes</option><option value="Recent surgery">Recent surgery</option></select>' +
            '</td>' +
            '<td>' +
            '<input type="text" name="detail[]"  class="form-control" required /></td>' +
            '<td><button type="button" class="btn btn-outline-danger remove-input-field">Delete</button></td></tr>'
        );
    });
    $(document).on('click', '.remove-input-field', function () {
        $(this).parents('tr').remove();
    });
</script>
@endsection

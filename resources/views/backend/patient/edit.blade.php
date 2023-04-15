@extends('backend.master.master')

@section('title')
Edit  Patient | {{ $ins_name }}
@endsection


@section('body')
<div class="page-content">
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0">Patient Information</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Forms</a></li>
                            <li class="breadcrumb-item active"> Patient</li>
                        </ol>
                    </div>

                </div>
            </div>
        </div>
         <form action="{{ route('patients.update',$patientList->id) }}" method="post" enctype="multipart/form-data" id="form" data-parsley-validate="">
            @csrf
            @method('PUT')
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
                                        <input type="file" class="form-control" name="image" id="" placeholder="Name" >
<img src="{{ asset('/') }}{{ $patientList->image }}" height="50px;" />
                                    </div>
                                </div>
                                <div class="col-xxl-6 col-md-6">
                                    <div>
                                        <label for="" class="form-label">Name</label>
                                        <input type="text" class="form-control" name="name" value="{{ $patientList->name }}" id="" placeholder="Name" required>
                                    </div>
                                </div>
                                <div class="col-xxl-6 col-md-6">
                                    <div>
                                        <label for="" class="form-label">Reffere From</label>
                                        <input type="text" class="form-control" value="{{ $patientList->refer_from }}" name="refer_from" id="" placeholder="Name" required>
                                    </div>
                                </div>
                                <div class="col-xxl-6 col-md-6">
                                    <div>
                                        <label for="" class="form-label">Age</label>
                                        <input type="text" class="form-control" value="{{ $patientList->age }}" name="age" id="" placeholder="Age" required>
                                    </div>
                                </div>
                                <div class="col-xxl-6 col-md-6">
                                    <div>
                                        <label for="" class="form-label">Gender</label>
                                        <select class="form-control" name="gender" id="" required>
                                            <option value="Male" {{ 'Male' == $patientList->gender }}>Male</option>
                                            <option value="Female" {{ 'Female' == $patientList->gender }}>Female</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-xxl-6 col-md-6">
                                    <div>
                                        <label for="" class="form-label">Address</label>
                                        <input type="text" class="form-control" value="{{ $patientList->address }}" id="" placeholder="Address" name="address" required>
                                    </div>
                                </div>
                                <div class="col-xxl-6 col-md-6">
                                    <div>
                                        <label for="" class="form-label">Email Address</label>
                                        <input type="email" class="form-control" id="" value="{{ $patientList->email_address }}" name="email_address"
                                               placeholder="Email Address" required>
                                    </div>
                                </div>
                                <div class="col-xxl-6 col-md-6">
                                    <div>
                                        <label for="" class="form-label">Phone/Mobile Number</label>
                                        <input type="text" class="form-control" id="" value="{{ $patientList->phone_or_mobile_number }}" name="phone_or_mobile_number" maxlength="11"
                                               placeholder="Phone Number" required>
                                    </div>
                                </div>
                                <div class="col-xxl-6 col-md-6">
                                    <div>
                                        <label for="" class="form-label">National ID Number</label>
                                        <input type="text" class="form-control" id="" value="{{ $patientList->nid_number }}" name="nid_number"
                                               placeholder="National ID Number" required>
                                    </div>
                                </div>
                                <div class="col-xxl-6 col-md-6">
                                    <div>
                                        <label for="" class="form-label">Nationality</label>
                                        <input type="text" class="form-control" name="nationality" value="{{ $patientList->nationality }}" id="" placeholder="Nationality" required>
                                    </div>
                                </div>
                                <div class="col-xxl-12 col-md-12">
                                    <div>
                                        <label for="" class="form-label">How did you come to know about this
                                            center</label>
                                        <textarea class="form-control" name="how_did_you_come_to_know_about_this_center" value="" id="" rows="3"
                                                  style="height: 101px;" required>{{ $patientList->how_did_you_come_to_know_about_this_center }}</textarea>
                                    </div>
                                </div>
                                <div class="col-xxl-12 col-md-12">
                                    <div>
                                        <label for="" class="form-label">Do you have earlier experience of
                                            Ayurveda, please give details </label>
                                        <textarea class="form-control" name="do_you_have_earlier_experience_of_ayurveda_please_give_details" id="" rows="3"
                                                  style="height: 101px;" required>{{ $patientList->do_you_have_earlier_experience_of_ayurveda_please_give_details }}</textarea>
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
                    <div class="card-body">
                        <div class="row gy-4">
                            <div class="col-xxl-12 col-md-12">
                                <div>
                                    <label for="" class="form-label">Did you have symptoms in past 1 weak (high fever, runny nose, cough, others)</label>
                                    <textarea class="form-control" id="" rows="3"
                                              style="height: 101px;" name="do_you_have_symptoms_in_past_one_weak" required>{{ $patientList->do_you_have_symptoms_in_past_one_weak }}</textarea>
                                </div>
                            </div>
                            <div class="col-xxl-12 col-md-12">
                                <div>
                                    <label for="" class="form-label">Have you undergone the covid 19 test?</label>
                                    <select class="form-control" name="covid_test_result" id="" required>
                                        <option value="Yes" {{ 'Yes' == $patientList->covid_test_result }}>Yes</option>
                                        <option value="No" {{ 'No' == $patientList->covid_test_result }}>No</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header align-items-center d-flex">
                        <h4 class="card-title mb-0 flex-grow-1">File Upload</h4>
                    </div><!-- end card header -->
                    <div class="card-body">

                            <table class="table table-bordered" id="dynamicAddRemove">
                                <tr>
                                    <th>Name</th>
                                    <th>File</th>
                                </tr>
                                <tr>
                                    <td>
                                        <input type="text" name="file_name[]" value=""
                                               class="form-control" />
                                    </td>
                                    <td>
                                        <input type="file" name="file[]" value=""
                                               class="form-control" />
                                    </td>
                                    <td>
                                        <button type="button" name="add" id="dynamic-ar"
                                                class="btn btn-outline-primary">Add New File
                                        </button>
                                    </td>
                                </tr>
                            </table>

                    </div>
                </div>
            </div>
            <!--end col-->
        </div>
        <button type="submit" class="btn btn-primary w-sm" >Submit</button>

    </form>

    <div class="row mt-2">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header align-items-center d-flex">
                    <h4 class="card-title mb-0 flex-grow-1">Update Previous File Upload</h4>
                </div><!-- end card header -->
                <div class="card-body">
<?php $patientList->patientFiles ?>

                    <div class="row">
@foreach($patientList->patientFiles as $viewAllFiles)
                        <div class="col-md-4">
                            <h6>Name :{{ $viewAllFiles->name }}</h6>
                            <h6>Image : <img src="{{ asset('/') }}{{ $viewAllFiles->file }}" height="60px" /></h6>




                            @if (Auth::guard('admin')->user()->can('rewardUpdate'))
                            <button type="button" data-bs-toggle="modal" data-bs-target=".bs-example-modal-lg{{ $viewAllFiles->id }}"
                            class="btn btn-primary waves-light waves-effect  btn-sm" >
                            <i class="ri-pencil-fill"></i></button>

                              <!--  Large modal example -->
                              <div class="modal fade bs-example-modal-lg{{ $viewAllFiles->id }}" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                                  <div class="modal-dialog modal-lg">
                                      <div class="modal-content">
                                          <div class="modal-header">
                                              <h5 class="modal-title" id="myLargeModalLabel">Update File</h5>
                                              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                              </button>
                                          </div>
                                          <div class="modal-body">
                                            <form action="{{ route('patientFileUpdate') }}" method="post" enctype="multipart/form-data" id="form" data-parsley-validate="">
                                                @csrf
                                                <input type="hidden" class="form-control" value="{{ $viewAllFiles->id }}" name="mainid" id="" placeholder="Name" required>
                                                <div class="row">

                                                    <div class="col-12 mb-2">
                                                        <label for="" class="form-label">Name</label>
                                                        <input type="text" class="form-control" value="{{ $viewAllFiles->name }}" name="mainname" id="" placeholder="Name" required>
                                                    </div>


                                                    <div class="col-12 mb-2">
                                                        <label for="" class="form-label">file</label>
                                                        <input type="file" class="form-control"  name="mainfile" id="">
                                                        <img src="{{ asset('/') }}{{ $viewAllFiles->file }}" height="60px" />
                                                    </div>


                                                </div>
                                                <button type="submit" class="btn btn-primary mt-3">Update</button>
                                            </form>
                                          </div>
                                      </div><!-- /.modal-content -->
                                  </div><!-- /.modal-dialog -->
                              </div><!-- /.modal -->


@endif

{{-- <button type="button" class="btn btn-primary waves-light waves-effect  btn-sm" onclick="window.location.href='{{ route('admin.users.view',$user->id) }}'"><i class="fa fa-eye"></i></button> --}}

                    @if (Auth::guard('admin')->user()->can('rewardDelete'))

<button   type="button" class="btn btn-danger waves-light waves-effect  btn-sm" onclick="deleteTag({{ $viewAllFiles->id}})" data-toggle="tooltip" title="Delete"><i class="ri-delete-bin-5-fill"></i></button>
<form id="delete-form-{{ $viewAllFiles->id }}" action="{{ route('patientFileDelete',$viewAllFiles->id) }}" method="POST" style="display: none;">
@method('DELETE')
                  @csrf

              </form>
                                  @endif


                        </div>
@endforeach
                    </div>




                </div>
            </div>
        </div>
        <!--end col-->
    </div>


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
            '<input type="text" name="file_name[]" value=""class="form-control" required/>' +
            '</td>' +
            '<td>' +
            '<input type="file" name="file[]"  class="form-control" required /></td>' +
            '<td><button type="button" class="btn btn-outline-danger remove-input-field">Delete</button></td></tr>'
        );
    });
    $(document).on('click', '.remove-input-field', function () {
        $(this).parents('tr').remove();
    });
</script>
@endsection

@extends('backend.master.master')

@section('title')
Update Doctor List | {{ $ins_name }}
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
        <form action="{{ route('doctorUpdate') }}"  method="post" enctype="multipart/form-data" id="form" data-parsley-validate="">

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
                                        <input type="text" class="form-control" id="" placeholder="Name" name="name" value="{{ $doctorList->name }}" required>
                                        <input type="hidden" class="form-control" id="" placeholder="id" name="id" value="{{ $doctorList->id }}">
                                    </div>
                                </div>
                                <div class="col-xxl-6 col-md-6">
                                    <div>
                                        <label for="" class="form-label">Address</label>
                                        <input type="text" class="form-control" id="" placeholder="Address" name="address" value="{{ $doctorList->address }}" required>
                                    </div>
                                </div>
                                <div class="col-xxl-6 col-md-6">
                                    <div>
                                        <label for="" class="form-label">Gender</label>
                                        <select class="form-control" name="gender" id="" required>
                                            <option value="Male" {{ 'Male' == $doctorList->gender ? 'selected':''   }}>Male</option>
                                            <option value="Female" {{ 'Female' == $doctorList->gender ? 'selected':''   }}>Female</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-xxl-6 col-md-6">
                                    <div>
                                        <label for="" class="form-label">Email Address</label>
                                        <input type="email" class="form-control" id="" value="{{ $doctorList->email_address }}" name="email_address" required
                                               placeholder="Email Address">
                                    </div>
                                </div>
                                <div class="col-xxl-6 col-md-6">
                                    <div>
                                        <label for="" class="form-label">Phone/Mobile Number</label>
                                        <input type="text" class="form-control" id="" name="phone_or_mobile_number" value="{{ $doctorList->phone_or_mobile_number }}" required
                                               placeholder="Phone Number">
                                    </div>
                                </div>
                                <div class="col-xxl-6 col-md-6">
                                    <div>
                                        <label for="" class="form-label">National ID Number</label>
                                        <input type="text" class="form-control" id=""
                                               placeholder="National ID Number" name="nid_number" value="{{ $doctorList->nid_number }}" required>
                                    </div>
                                </div>
                                <div class="col-xxl-6 col-md-6">
                                    <div>
                                        <label for="" class="form-label">Nationality</label>
                                        <input type="text" class="form-control" name="nationality" value="{{ $doctorList->nationality }}" id="" placeholder="Nationality" required>
                                    </div>
                                </div>
                                <div class="col-xxl-6 col-md-6">
                                    <div>
                                        <label for="" class="form-label">Years Of Experience</label>
                                        <input type="text" class="form-control" name="years_of_experience" value="{{ $doctorList->years_of_experience }}" id="" placeholder="Years Of Experience" required>
                                    </div>
                                </div>
                                <div class="col-xxl-6 col-md-6">
                                    <div>
                                        <label for="" class="form-label">Doctor's Certificate</label>
                                        <input type="file" class="form-control" name="doctor_certificate" id="" placeholder="Years Of Experience">

                                        <img src="{{ asset('/') }}{{ $doctorList->doctor_certificate }}" height="100px" />
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

        <?php $doctorList->doctorConsultDates ?>
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
                                @foreach($doctorList->doctorConsultDates as $key=>$allConsultTime)
                                @if($key+1 == 1)
                                <tr>
                                    <td>
                                        <select class="form-select mb-3" name="doctor_day[]" aria-label="Default select example" required>
                                            <option >Open this select menu</option>
                                            <option value="Saturday" {{ 'Saturday'==$allConsultTime->day ? 'selected':'' }}>Saturday</option>
                                            <option value="Sunday" {{ 'Sunday'==$allConsultTime->day ? 'selected':'' }}>Sunday</option>
                                            <option value="Monday" {{ 'Monday'==$allConsultTime->day ? 'selected':'' }}>Monday</option>
                                            <option value="Tuesday" {{ 'Tuesday'==$allConsultTime->day ? 'selected':'' }}>Tuesday</option>
                                            <option value="Wednesday" {{ 'Wednesday'==$allConsultTime->day ? 'selected':'' }}>Wednesday</option>
                                            <option value="Thursday" {{ 'Thursday'==$allConsultTime->day ? 'selected':'' }}>Thursday</option>
                                            <option value="Friday" {{ 'Friday'==$allConsultTime->day ? 'selected':'' }}>Friday</option>
                                        </select>
                                    </td>
                                    <td>
                                        <input type="time" name="start_time[]"
                                               class="form-control" value="{{ $allConsultTime->start_time }}" required/>
                                    </td>
                                    <td>
                                        <input type="time" name="end_time[]"
                                               class="form-control" value="{{ $allConsultTime->end_time }}" required/>
                                    </td>
                                    <td>
                                        <button type="button" name="add" id="dynamic-ar"
                                                class="btn btn-outline-primary">Add New Date
                                        </button>
                                    </td>
                                </tr>
                                @else
                                <tr>
                                    <td>
                                        <select class="form-select mb-3" name="doctor_day[]" aria-label="Default select example" required>
                                            <option >Open this select menu</option>
                                            <option value="Saturday" {{ 'Saturday'==$allConsultTime->day ? 'selected':'' }}>Saturday</option>
                                            <option value="Sunday" {{ 'Sunday'==$allConsultTime->day ? 'selected':'' }}>Sunday</option>
                                            <option value="Monday" {{ 'Monday'==$allConsultTime->day ? 'selected':'' }}>Monday</option>
                                            <option value="Tuesday" {{ 'Tuesday'==$allConsultTime->day ? 'selected':'' }}>Tuesday</option>
                                            <option value="Wednesday" {{ 'Wednesday'==$allConsultTime->day ? 'selected':'' }}>Wednesday</option>
                                            <option value="Thursday" {{ 'Thursday'==$allConsultTime->day ? 'selected':'' }}>Thursday</option>
                                            <option value="Friday" {{ 'Friday'==$allConsultTime->day ? 'selected':'' }}>Friday</option>
                                        </select>
                                    </td>
                                    <td>
                                        <input type="time" name="start_time[]"
                                               class="form-control" value="{{ $allConsultTime->start_time }}" required/>
                                    </td>
                                    <td>
                                        <input type="time" name="end_time[]"
                                               class="form-control" value="{{ $allConsultTime->end_time }}" required/>
                                    </td>
                                    <td>
                                        <button type="button" class="btn btn-outline-danger remove-input-field">Delete</button>
                                    </td>
                                </tr>
                                @endif
                                @endforeach
                            </table>

                    </div>
                </div>
            </div>
            <!--end col-->
        </div>

        <div class="text-end mb-3">
            <button type="submit" class="btn btn-primary w-sm" >Update</button>
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

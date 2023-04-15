@extends('backend.master.master')

@section('title')
Patient Info | {{ $ins_name }}
@endsection


@section('body')
 <div class="page-content">
            <div class="container-fluid">
                <div class="profile-foreground position-relative mx-n4 mt-n4">
                    <div class="profile-wid-bg bg-transparent border-top">
                        <!-- <img src="assets/images/profile-bg.jpg" alt="" class="profile-wid-img" /> -->
                    </div>
                </div>
                <div class="pt-4 mb-4 mb-lg-3 pb-lg-4">
                    <div class="row g-4">
                        <div class="col-auto">
                            <div class="avatar-lg">
                                <img src="{{asset('/')}}{{$walkByPatientList->image}}" alt="user-img"
                                     class="img-thumbnail rounded-circle"/>
                            </div>
                        </div>
                        <!--end col-->
                        <div class="col">
                            <div class="p-2">
                                <h3 class="text-white mb-1">{{$walkByPatientList->name}}</h3>
                                <p class="text-white-75">{{$walkByPatientList->phone_or_mobile_number}}</p>
                                <div class="hstack text-white-50 gap-1">
                                    <div class="me-2"><i
                                                class="ri-map-pin-user-line me-1 text-white-75 fs-16 align-middle"></i>{{$walkByPatientList->address}}
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--end col-->
                        <div class="col-12 col-lg-auto order-last order-lg-0">
                            <div class="row text text-white-50 text-center">
                                <div class="col-lg-6 col-4">
                                    <div class="p-2">
                                        <h4 class="text-white mb-1">{{$totalAmount}}</h4>
                                        <p class="fs-14 mb-0">Amount</p>
                                    </div>
                                </div>
                                <!--<div class="col-lg-6 col-4">-->
                                <!--    <div class="p-2">-->
                                <!--        <h4 class="text-white mb-1">1.3K</h4>-->
                                <!--        <p class="fs-14 mb-0">Due</p>-->
                                <!--    </div>-->
                                <!--</div>-->
                            </div>
                        </div>
                        <!--end col-->

                    </div>
                    <!--end row-->
                </div>

                <div class="row">
                    <div class="col-lg-12">
                        <div>
                            <div class="d-flex">
                                <!-- Nav tabs -->
                                <ul class="nav nav-pills animation-nav profile-nav gap-2 gap-lg-3 flex-grow-1"
                                    role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link fs-14 active" data-bs-toggle="tab" href="#overview-tab"
                                           role="tab">
                                            <i class="ri-airplay-fill d-inline-block d-md-none"></i> <span
                                                    class="d-none d-md-inline-block">Overview</span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link fs-14" data-bs-toggle="tab" href="#activities" role="tab">
                                            <i class="ri-list-unordered d-inline-block d-md-none"></i> <span
                                                    class="d-none d-md-inline-block">Appointment</span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link fs-14" data-bs-toggle="tab" href="#projects" role="tab">
                                            <i class="ri-price-tag-line d-inline-block d-md-none"></i> <span
                                                    class="d-none d-md-inline-block">Therapy</span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link fs-14" data-bs-toggle="tab" href="#documents" role="tab">
                                            <i class="ri-folder-4-line d-inline-block d-md-none"></i> <span
                                                    class="d-none d-md-inline-block">Documents</span>
                                        </a>
                                    </li>
                                </ul>
                                <div class="flex-shrink-0">
                                    <a href="{{ route('walkByPatients.edit',$walkByPatientList->id) }}" class="btn btn-success"><i class="ri-edit-box-line align-bottom"></i>
                                        Edit Profile</a>
                                </div>
                            </div>
                            <!-- Tab panes -->
                            <div class="tab-content pt-4 text-muted">
                                <div class="tab-pane active" id="overview-tab" role="tabpanel">
                                    <div class="row">
                                        <div class="col-xxl-3">

                                            <div class="card">
                                                <div class="card-body">
                                                    <h5 class="card-title mb-3">Info</h5>
                                                    <div class="table-responsive">
                                                        <table class="table table-borderless mb-0">
                                                            <tbody>
                                                            <tr>
                                                                <th class="ps-0" scope="row">Reffere From :</th>
                                                                <td class="text-muted">{{$walkByPatientList->refer_from}}</td>
                                                            </tr>
                                                            <tr>
                                                                <th class="ps-0" scope="row">Age :</th>
                                                                <td class="text-muted">{{$walkByPatientList->age}}</td>
                                                            </tr>
                                                            <tr>
                                                                <th class="ps-0" scope="row">E-mail :</th>
                                                                <td class="text-muted">{{$walkByPatientList->email_address}}</td>
                                                            </tr>
                                                            <tr>
                                                                <th class="ps-0" scope="row">Gender :</th>
                                                                <td class="text-muted">{{$walkByPatientList->gender}}
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <th class="ps-0" scope="row">National ID Card</th>
                                                                <td class="text-muted">{{$walkByPatientList->nid_number}}</td>
                                                            </tr>
                                                            <tr>
                                                                <th class="ps-0" scope="row">Nationality</th>
                                                                <td class="text-muted">{{$walkByPatientList->nationality}}</td>
                                                            </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div><!-- end card body -->
                                            </div><!-- end card -->
                                        </div>
                                        <!--end col-->
                                        <div class="col-xxl-9">
                                            <div class="card">
                                                <div class="card-body">
                                                    <h5 class="card-title mb-3">How did you come to know about this
                                                        center</h5>
                                                    <p>{{$walkByPatientList->how_did_you_come_to_know_about_this_center}}</p>
                                                    <h5 class="card-title mb-3">Do you have earlier experience of
                                                        Ayurveda, please give details</h5>
                                                    <p>{{$walkByPatientList->do_you_have_earlier_experience_of_ayurveda_please_give_details	}}</p>
                                                    <h5 class="card-title mb-3">Did you have symptoms in past 1 weak
                                                        (high fever, runny nose, cough, others)</h5>
                                                    <p>{{$walkByPatientList->do_you_have_symptoms_in_past_one_weak	}}</p>
                                                    <h5 class="card-title mb-3">Have you undergone the covid 19
                                                        test?</h5>
                                                    <p>{{$walkByPatientList->covid_test_result	}}</p>
                                                </div>
                                                <!--end card-body-->
                                            </div><!-- end card -->




                                        </div>
                                        <!--end col-->
                                    </div>
                                    <!--end row-->
                                </div>
                                <div class="tab-pane fade" id="activities" role="tabpanel">
                                    <div class="card">
                                        <div class="card-body">
                                            <h5 class="card-title mb-3">Appointment</h5>
                                            <table class="table table-responsive table-bordered">
                                                <tr>
                                                    <th>Appointment To</th>
                                                    <th>Date</th>
                                                 
                                                    <th>Status</th>
                                                </tr>
                                                @foreach($doctorAppoinmentList as $mm)
                                                <tr>
                                                    <td>{{ $mm->doctor->name }}</td>
                                                    <td>{{$mm->appointment_date}}</td>
                                                   
                                                    <td>
                                                        @if($mm->status == 1)
                                                        Recieved
                                                        @else
                                                        Pending
                                                        @endif
                                                        
                                                        </td>
                                                </tr>
                                                @endforeach
                                            </table>
                                        </div>
                                        <!--end card-body-->
                                    </div>
                                    <!--end card-->
                                </div>
                                <!--end tab-pane-->
                                <div class="tab-pane fade" id="projects" role="tabpanel">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="row">
                                                @foreach($getAppoinmentDetail as $allGetAppoinmentDetail)
                                                
                                                <?php 
                                                $therapy_name = DB::table('therapy_lists')->where('id',$allGetAppoinmentDetail->therapy_name)->value('name');
                                                 $therapy_time = DB::table('therapy_appointment_date_and_times')->where('therapy_appointment_id',$allGetAppoinmentDetail->therapy_appointment_id)->value('therapist');
                                                      $therapy_date = DB::table('therapy_appointment_date_and_times')->where('therapy_appointment_id',$allGetAppoinmentDetail->therapy_appointment_id)->value('date');
                                            $therapis_name = DB::table('therapists')->where('id',$therapy_time)->value('name');
                                                ?>
                                                <div class="col-xxl-3 col-sm-6">
                                                    <div class="card profile-project-card shadow-none profile-project-warning">
                                                        <div class="card-body p-4">
                                                            <div class="d-flex">
                                                                <div class="flex-grow-1 text-muted overflow-hidden">
                                                                    <h5 class="fs-14 text-truncate"><a href="#"
                                                                                                       class="text-dark">Therapy Name: {{$therapy_name}}</a></h5>
                                                                    <p class="text-muted text-truncate mb-0">Date
                                                                        :
                                                                        <span class="fw-semibold text-dark">: {{$therapy_date}}</span>
                                                                    </p>
                                                                    <p class="text-muted text-truncate mb-0">Therapist
                                                                        :
                                                                        <span class="fw-semibold text-dark">: {{$therapis_name}}</span>
                                                                    </p>
                                                                </div>
                                                                <div class="flex-shrink-0 ms-2">
                                                                    <!--<div class="badge badge-soft-warning fs-10">-->
                                                                    <!--    Ongoing-->
                                                                    <!--</div>-->
                                                                </div>
                                                            </div>

                                                            <!--<div class="d-flex mt-4">-->
                                                            <!--    <div class="flex-grow-1">-->
                                                            <!--        <div class="d-flex align-items-center gap-2">-->
                                                            <!--            <div>-->
                                                            <!--                <h5 class="fs-12 text-muted mb-0">Therapist-->
                                                            <!--                    : Dear X</h5>-->
                                                            <!--            </div>-->
                                                            <!--        </div>-->
                                                            <!--        <table class="table table-bordered table-responsive mt-3">-->
                                                            <!--            <tr>-->
                                                            <!--                <th class="fs-12 text-muted mb-0">Ingredient</th>-->
                                                            <!--                <th class="fs-12 text-muted mb-0">Amount</th>-->
                                                            <!--            </tr>-->
                                                            <!--            <tr>-->
                                                            <!--                <td class="fs-12 text-muted mb-0">X</td>-->
                                                            <!--                <td class="fs-12 text-muted mb-0">1GM</td>-->
                                                            <!--            </tr>-->
                                                            <!--        </table>-->
                                                            <!--    </div>-->
                                                            <!--</div>-->
                                                        </div>
                                                        <!-- end card body -->
                                                    </div>
                                                    <!-- end card -->
                                                </div>
                                                @endforeach
                                                <!--end col-->
                                                <!--<div class="col-xxl-3 col-sm-6">-->
                                                <!--    <div class="card profile-project-card shadow-none profile-project-success">-->
                                                <!--        <div class="card-body p-4">-->
                                                <!--            <div class="d-flex">-->
                                                <!--                <div class="flex-grow-1 text-muted overflow-hidden">-->
                                                <!--                    <h5 class="fs-14 text-truncate"><a href="#"-->
                                                <!--                                                       class="text-dark">Therapy Name</a></h5>-->
                                                <!--                    <p class="text-muted text-truncate mb-0">Date-->
                                                <!--                        : <span class="fw-semibold text-dark">: 1/123</span>-->
                                                <!--                    </p>-->
                                                <!--                </div>-->
                                                <!--                <div class="flex-shrink-0 ms-2">-->
                                                <!--                    <div class="badge badge-soft-primary fs-10">-->
                                                <!--                        Not Received-->
                                                <!--                    </div>-->
                                                <!--                </div>-->
                                                <!--            </div>-->

                                                <!--            <div class="d-flex mt-4">-->
                                                <!--                <div class="flex-grow-1">-->
                                                <!--                    <div class="d-flex align-items-center gap-2">-->
                                                <!--                        <div>-->
                                                <!--                            <h5 class="fs-12 text-muted mb-0">Therapist-->
                                                <!--                                : Dear X</h5>-->
                                                <!--                        </div>-->
                                                <!--                    </div>-->
                                                <!--                    <table class="table table-bordered table-responsive mt-3">-->
                                                <!--                        <tr>-->
                                                <!--                            <th class="fs-12 text-muted mb-0">Ingredient</th>-->
                                                <!--                            <th class="fs-12 text-muted mb-0">Amount</th>-->
                                                <!--                        </tr>-->
                                                <!--                        <tr>-->
                                                <!--                            <td class="fs-12 text-muted mb-0">X</td>-->
                                                <!--                            <td class="fs-12 text-muted mb-0">1GM</td>-->
                                                <!--                        </tr>-->
                                                <!--                    </table>-->
                                                <!--                </div>-->
                                                <!--            </div>-->
                                                <!--        </div>-->
                                                        <!-- end card body -->
                                                <!--    </div>-->
                                                 
                                                <!--</div>-->
                                                <!--end col-->
                                                <!--<div class="col-lg-12">-->
                                                <!--    <div class="mt-4">-->
                                                <!--        <ul class="pagination pagination-separated justify-content-center mb-0">-->
                                                <!--            <li class="page-item disabled">-->
                                                <!--                <a href="javascript:void(0);" class="page-link"><i-->
                                                <!--                            class="mdi mdi-chevron-left"></i></a>-->
                                                <!--            </li>-->
                                                <!--            <li class="page-item active">-->
                                                <!--                <a href="javascript:void(0);" class="page-link">1</a>-->
                                                <!--            </li>-->
                                                <!--            <li class="page-item">-->
                                                <!--                <a href="javascript:void(0);" class="page-link">2</a>-->
                                                <!--            </li>-->
                                                <!--            <li class="page-item">-->
                                                <!--                <a href="javascript:void(0);" class="page-link">3</a>-->
                                                <!--            </li>-->
                                                <!--            <li class="page-item">-->
                                                <!--                <a href="javascript:void(0);" class="page-link">4</a>-->
                                                <!--            </li>-->
                                                <!--            <li class="page-item">-->
                                                <!--                <a href="javascript:void(0);" class="page-link">5</a>-->
                                                <!--            </li>-->
                                                <!--            <li class="page-item">-->
                                                <!--                <a href="javascript:void(0);" class="page-link"><i-->
                                                <!--                            class="mdi mdi-chevron-right"></i></a>-->
                                                <!--            </li>-->
                                                <!--        </ul>-->
                                                <!--    </div>-->
                                                <!--</div>-->
                                            </div>
                                            <!--end row-->
                                        </div>
                                        <!--end card-body-->
                                    </div>
                                    <!--end card-->
                                </div>
                                <!--end tab-pane-->
                                <div class="tab-pane fade" id="documents" role="tabpanel">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="d-flex align-items-center mb-4">
                                                <h5 class="card-title flex-grow-1 mb-0">Documents</h5>
                                                <div class="flex-shrink-0">
                                                    <!--<input class="form-control d-none" type="file" id="formFile">-->
                                                    <!--<label for="formFile" class="btn btn-danger"><i-->
                                                    <!--            class="ri-upload-2-fill me-1 align-bottom"></i> Upload-->
                                                    <!--    File</label>-->
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <div class="table-responsive">
                                                        <table class="table table-borderless align-middle mb-0">
                                                            <thead class="table-light">
                                                            <tr>
                                                                <th scope="col">File Name</th>
                                                                
                                                            </tr>
                                                            </thead>
                                                            <tbody>
                                                             
                                                                <?php  
                                                                
                                                                 $get_file = 'https://ayurveda.resnova.dev/'.$walkByPatientList->routine;
                                                                  $fileInfo = pathinfo($get_file);
    $extension = $fileInfo['extension'];
    $filename = $fileInfo['filename'];
                                                                
                                                                ?>
                                                            <tr>
                                                                <td>
                                                                    <div class="d-flex align-items-center">
                                                                       
                                                                        <div class="ms-3 flex-grow-1">
                                                                            <h6 class="fs-15 mb-0"><a
                                                                                        href="javascript:void(0)">{{$filename}}.{{$extension}}</a>
                                                                            </h6>
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                             
                                                            </tr>
                                                      
                                                          
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                    <!--<div class="text-center mt-3">-->
                                                    <!--    <a href="javascript:void(0);" class="text-success"><i-->
                                                    <!--                class="mdi mdi-loading mdi-spin fs-20 align-middle me-2"></i>-->
                                                    <!--        Load more </a>-->
                                                    <!--</div>-->
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                end tab-pane
                            </div>
                            <!--end tab-content-->
                        </div>
                    </div>
                    <!--end col-->
                </div>
                <!--end row-->

            </div><!-- container-fluid -->
        </div><!-- End Page-content -->

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

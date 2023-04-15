@extends('backend.master.master')

@section('title')
Prescription List | {{ $ins_name }}
@endsection


@section('body')
<div class="page-content">
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0">Patient Prescription List</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Tables</a></li>
                            <li class="breadcrumb-item active">Prescription</li>
                        </ol>
                    </div>

                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title mb-0">Doctor Waiting Info</h4>
                        @include('flash_message')
                    </div><!-- end card header -->

                    <div class="card-body">
                        <div id="customerList">


                            <div class="table-responsive table-card mt-3 mb-1">
                                <table id="buttons-datatables" class="display table table-bordered" style="width:100%">
                                    <thead class="table-light">
                                    <tr>

                                        <th class="sort" data-sort="customer_name">SL No</th>
                                        <th class="sort" data-sort="customer_name">Patient Id</th>
                                        <th class="sort" data-sort="email">Name</th>
                                        <th class="sort" data-sort="email">Phone</th>
                                        <th class="sort" data-sort="email">Consult Doctor</th>

                                        <th class="sort" data-sort="action">Action</th>
                                    </tr>
                                    </thead>
                                    <tbody class="list form-check-all">
                                    @foreach($getHistoryData as $key=>$allGetHistoryData)
                                    <?php
                                      $getNameFromWalkByPatient = DB::table('walk_by_patients')
                                      ->where('patient_reg_id',$allGetHistoryData->patient_id)->value('name');
                                      $getNameFromPatient = DB::table('patients')
                                      ->where('patient_id',$allGetHistoryData->patient_id)->value('name');


                                      $getPhoneFromWalkByPatient = DB::table('walk_by_patients')
                                      ->where('patient_reg_id',$allGetHistoryData->patient_id)->value('phone_or_mobile_number');
                                      $getPhoneFromPatient = DB::table('patients')
                                      ->where('patient_id',$allGetHistoryData->patient_id)->value('phone_or_mobile_number');
                                    ?>
                                    <tr>


                                        <td class="customer_name">{{ $key+1}}</td>
                                        <td class="email">{{ $allGetHistoryData->patient_id }}</td>
                                        <td class="email">

                                            @if(empty($getNameFromWalkByPatient))

{{ $getNameFromPatient }}
                                            @else
{{ $getNameFromWalkByPatient }}
                                            @endif
                                        </td>
                                        <td class="email">
                                            @if(empty($getPhoneFromWalkByPatient))

                                            {{ $getPhoneFromPatient }}
                                                                                        @else
                                            {{ $getPhoneFromWalkByPatient }}
                                                                                        @endif
                                        </td>
                                        <td class="email">{{ $allGetHistoryData->doctor->name }}</td>



                                        <td>
                                            <div class="dropdown d-inline-block">


                                                    @if (Auth::guard('admin')->user()->can('patientPrescriptionListView'))
                                                 <a href="{{ route('patientPrecriptions.show',$allGetHistoryData->id) }}" class="btn btn-primary btn-sm" >view</a>
                                                    @endif

                                                </ul>
                                            </div>
                                        </td>
                                    </tr>
@endforeach
                                    </tbody>
                                </table>

                            </div>


                        </div>
                    </div><!-- end card -->
                </div>
                <!-- end col -->
            </div>
            <!-- end col -->
        </div>
        <!-- end row -->

    </div>
    <!-- container-fluid -->
</div>
@endsection
@section('script')

@endsection

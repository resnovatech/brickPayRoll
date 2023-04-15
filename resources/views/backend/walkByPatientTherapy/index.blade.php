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


        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title mb-0">Doctor Appointment Info</h4>
                        @include('flash_message')
                    </div><!-- end card header -->

                    <div class="card-body">
                        <div id="customerList">
                            <div class="row g-4 mb-3">
                                <div class="col-sm-auto">
                                    <div>
                                        <button type="button" class="btn btn-primary add-btn" onclick="location.href='{{ route('walkByPatientTherapy.create') }}'"><i class="ri-add-line align-bottom me-1"></i> Add New Therapy Appoinment</button>

                                    </div>
                                </div>

                            </div>

                            <div class="table-responsive table-card mt-3 mb-1">
                                <table id="buttons-datatables" class="display table table-bordered" style="width:100%">
                                    <thead class="table-light">
                                    <tr>
                                        <th class="sort" data-sort="customer_name">Sl No</th>
                                        <th class="sort" data-sort="customer_name">Serial Number</th>
                                        <th class="sort" data-sort="customer_name">Patient Id</th>
                                        <th class="sort" data-sort="customer_name">Patient Name</th>
                                        <th class="sort" data-sort="email">Doctor Name</th>
                                        <th class="sort" data-sort="phone">Appointment Data</th>
                                        <th class="sort" data-sort="phone">Status</th>
                                        <th class="sort" data-sort="action">Action</th>
                                    </tr>
                                    </thead>
                                    <tbody class="list form-check-all">
                                    @foreach($therapyAppointmentDateAndTimeList as $key=>$allTherapyAppointmentDateAndTimeList)

                                 <?php
                                    $getNameFromWalkByPatient = DB::table('walk_by_patients')
                                    ->where('patient_reg_id',$allTherapyAppointmentDateAndTimeList->patient_id)->value('name');
                                    $getNameFromPatient = DB::table('patients')
                                    ->where('patient_id',$allTherapyAppointmentDateAndTimeList->patient_id)->value('name');


                                  ?>

                                    <tr>

                                        <td class="email">{{ $key+1 }}</td>
                                        <td class="customer_name">{{ $allTherapyAppointmentDateAndTimeList->serial }}</td>
                                        <td class="email">{{ $allTherapyAppointmentDateAndTimeList->patient_id }}</td>
                                        <td class="email">

                                            @if(empty($getNameFromWalkByPatient))

{{ $getNameFromPatient }}
                                            @else
{{ $getNameFromWalkByPatient }}
                                            @endif
                                        </td>
                                        <td class="email">

                                            <?php
 $getNameTherapist = DB::table('therapists')
                                    ->where('id',$allTherapyAppointmentDateAndTimeList->therapist)->value('name');

                                            ?>

                                            {{ $getNameTherapist }}

                                        </td>
                                        <td class="phone">{{ $allTherapyAppointmentDateAndTimeList->date }}</td>

<td class="phone">Not Received</td>
                                        <td>
                                            <div class="dropdown d-inline-block">
                                                <button class="btn btn-soft-primary btn-sm dropdown" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                    <i class="ri-more-fill align-middle"></i>
                                                </button>
                                                <ul class="dropdown-menu dropdown-menu-end">
                                                    @if (Auth::guard('admin')->user()->can('therapyAppointmentView'))
                                                    <li><a href="{{ route('walkByPatientTherapy.show',$allTherapyAppointmentDateAndTimeList->id) }}" class="dropdown-item"><i class="ri-eye-fill align-bottom me-2 text-muted"></i> View</a></li>
                                                    @endif
                                                    @if (Auth::guard('admin')->user()->can('therapyAppointmentUpdate'))
                                                    {{-- <li><a class="dropdown-item edit-item-btn" href="{{ route('therapyAppointments.edit',$allTherapyAppointmentDateAndTimeList->id) }}"><i class="ri-pencil-fill align-bottom me-2 text-muted"></i> Edit</a></li> --}}
                                                    @endif
                                                    @if (Auth::guard('admin')->user()->can('therapyAppointmentDelete'))
                                                    <a class="dropdown-item remove-item-btn" onclick="deleteTag({{ $allTherapyAppointmentDateAndTimeList->id}})" >
                                                        <i class="ri-delete-bin-fill align-bottom me-2 text-muted"></i> Delete
                                                    </a>
                                                    <form id="delete-form-{{ $allTherapyAppointmentDateAndTimeList->id }}" action="{{ route('walkByPatientTherapy.destroy',$allTherapyAppointmentDateAndTimeList->id) }}" method="POST" style="display: none;">
                                                        @method('DELETE')
                                                                                      @csrf

                                                                                  </form>
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
</div>
@endsection

@section('script')

@endsection

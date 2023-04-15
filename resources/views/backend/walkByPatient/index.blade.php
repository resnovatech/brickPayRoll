@extends('backend.master.master')

@section('title')
Walk By Patient List | {{ $ins_name }}
@endsection


@section('body')
<div class="page-content">
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0">Walk By Patient List</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Tables</a></li>
                            <li class="breadcrumb-item active">Walk-By-Patient</li>
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
                        <h4 class="card-title mb-0">Patient Info</h4>
                        @include('flash_message')
                    </div><!-- end card header -->

                    <div class="card-body">
                        <div id="customerList">
                            <div class="row g-4 mb-3">
                                <div class="col-sm-auto">
                                    <div>
                                        <button type="button" class="btn btn-primary add-btn" onclick="location.href='{{ route('walkByPatients.create') }}'"><i class="ri-add-line align-bottom me-1"></i> Add New Walk By Patient</button>

                                    </div>
                                </div>

                            </div>

                            <div class="table-responsive table-card mt-3 mb-1">
                                <table id="buttons-datatables" class="display table table-bordered" style="width:100%">
                                    <thead class="table-light">
                                    <tr>
                                        <th class="sort" data-sort="customer_name">SL</th>
                                        <th class="sort" data-sort="customer_name">Customer</th>
                                        <th class="sort" data-sort="email">Email</th>
                                        <th class="sort" data-sort="phone">Phone</th>
                                        <th class="sort" data-sort="date">Appoint Date</th>
                                        <th class="sort" data-sort="status">Service Status</th>
                                        <th class="sort" data-sort="action">Action</th>
                                    </tr>
                                    </thead>
                                    <tbody class="list form-check-all">
                                    @foreach($walkByPatientList as $key=>$allWalkByPatientList)
                                    <tr>

                                        <td class="id">{{ $key+1 }}</td>
                                        <td class="customer_name">{{ $allWalkByPatientList->name }}</td>
                                        <td class="email">{{ $allWalkByPatientList->email_address }}</td>
                                        <td class="phone">{{ $allWalkByPatientList->phone_or_mobile_number }}</td>
                                        <td class="date">{{ $allWalkByPatientList->created_at }}</td>
                                        <td class="status"><span class="badge badge-soft-success text-uppercase">Active</span></td>
                                        <td>
                                            <div class="dropdown d-inline-block">
                                                <button class="btn btn-soft-primary btn-sm dropdown" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                    <i class="ri-more-fill align-middle"></i>
                                                </button>
                                                <ul class="dropdown-menu dropdown-menu-end">
                                                    @if (Auth::guard('admin')->user()->can('WalkByPatientView'))
                                                    <li><a href="{{ route('transferToPatientList',$allWalkByPatientList->id) }}" class="dropdown-item"><i class="ri-file-fill align-bottom me-2 text-muted"></i>Transfer</a></li>
                                                    <li><a href="{{ route('walkByPatients.show',$allWalkByPatientList->id) }}" class="dropdown-item"><i class="ri-eye-fill align-bottom me-2 text-muted"></i> View</a></li>
                                                    @endif
                                                    @if (Auth::guard('admin')->user()->can('WalkByPatientUpdate'))
                                                    <li><a class="dropdown-item edit-item-btn" href="{{ route('walkByPatients.edit',$allWalkByPatientList->id) }}"><i class="ri-pencil-fill align-bottom me-2 text-muted"></i> Edit</a></li>
                                                    @endif
                                                    @if (Auth::guard('admin')->user()->can('WalkByPatientDelete'))
                                                    <a class="dropdown-item remove-item-btn" onclick="deleteTag({{ $allWalkByPatientList->id}})" >
                                                        <i class="ri-delete-bin-fill align-bottom me-2 text-muted"></i> Delete
                                                    </a>
                                                    <form id="delete-form-{{ $allWalkByPatientList->id }}" action="{{ route('walkByPatients.destroy',$allWalkByPatientList->id) }}" method="POST" style="display: none;">
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
    <!-- container-fluid -->
</div>
<!-- End Page-content -->

@endsection
@section('script')

@endsection

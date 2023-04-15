@extends('backend.master.master')

@section('title')
Designation List | {{ $ins_name }}
@endsection


@section('body')
<div class="page-content">
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0">Designation List</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Tables</a></li>
                            <li class="breadcrumb-item active">Designation List</li>
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
                        <h4 class="card-title mb-0">Designation Info</h4>
                        @include('flash_message')
                    </div><!-- end card header -->

                    <div class="card-body">
                        <div id="customerList">
                            <div class="row g-4 mb-3">
                                <div class="col-sm-auto">
                                    <div>
                                        <button type="button" class="btn btn-primary add-btn" data-bs-toggle="modal" data-bs-target="#myModal"><i class="ri-add-line align-bottom me-1"></i> Add New Designation Info</button>

                                    </div>
                                </div>

                            </div>

                            <div class="table-responsive table-card mt-3 mb-1">
                                <table id="buttons-datatables" class="display table table-bordered" style="width:100%">
                                    <thead class="table-light">
                                    <tr>
                                        <th class="sort" data-sort="customer_name">Sl</th>

                                        <th class="sort" data-sort="email">Designation Name</th>
                                        <th class="sort" data-sort="email">Department</th>
                                        <th class="sort" data-sort="email">Status</th>
                                        <th class="sort" data-sort="action">Action</th>
                                    </tr>
                                    </thead>
                                    <tbody class="list form-check-all">

                                        @foreach($designationLists as $key=>$allDepartmentLists)
                                    <tr>

                                        <td class="id">{{ $key+1 }}</td>

                                        <td class="customer_name">{{ $allDepartmentLists->designation_name }}</td>
                                        <td class="customer_name">{{ $allDepartmentLists->department->department_name }}</td>
                                        <td class="customer_name">{{ $allDepartmentLists->designation_status}}</td>

                                        <td>



                                            @if (Auth::guard('admin')->user()->can('designation_update'))
                                            <button type="button" data-bs-toggle="modal" data-bs-target=".bs-example-modal-lg{{ $allDepartmentLists->id }}"
                                            class="btn btn-primary waves-light waves-effect  btn-sm" >
                                            <i class="ri-pencil-fill"></i></button>

                                              <!--  Large modal example -->
                                              <div class="modal fade bs-example-modal-lg{{ $allDepartmentLists->id }}" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                                                  <div class="modal-dialog modal-lg">
                                                      <div class="modal-content">
                                                          <div class="modal-header">
                                                              <h5 class="modal-title" id="myLargeModalLabel">Update Designation Info</h5>
                                                              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                                              </button>
                                                          </div>
                                                          <div class="modal-body">
                                                            <form action="{{ route('designation.update',$allDepartmentLists->id) }}" method="post" enctype="multipart/form-data" id="form" data-parsley-validate="">
                                                                @csrf
                                                                @method('PUT')
                                                                <input type="hidden"  name ="admin_id" class="form-control" value="{{ Auth::guard('admin')->user()->id }}" required>
                                                                <div class="row">
                                                                    <div class="col-12 mb-2">
                                                                        <label for="" class="form-label">Name</label>
                                                                        <input type="text" value="{{ $allDepartmentLists->designation_name }}" name ="Designation_name" class="form-control" maxlength="50" id="" placeholder="Name" required>
                                                                    </div>

                                                                    <div class="col-12 mb-2">
                                                                        <label for="" class="form-label">Department</label>

                                                                        <select  name ="department_id" class="form-control"   required>
                                                                            @foreach($departmentLists as $departmentListsAll)
                                            <option value="{{ $departmentListsAll->id }}"  {{ $allDepartmentLists->department_id == $departmentListsAll->id ? 'selected':'' }}>{{ $departmentListsAll->department_name }}</option>
                                                                            @endforeach
                                                                        </select>
                                                                    </div>

                                                                    <div class="col-12 mb-2">
                                                                        <label for="" class="form-label">Status</label><br>
                                                                        <div class="form-check form-check-inline">
                                                                            <input class="form-check-input" type="radio" name="designation_status" id="inlineRadio1" value="Active" {{ $allDepartmentLists->designation_status == 'Active' ? 'checked':'' }}>
                                                                            <label class="form-check-label" for="inlineRadio1">Active</label>
                                                                          </div>
                                                                          <div class="form-check form-check-inline">
                                                                            <input class="form-check-input" type="radio" name="designation_status" id="inlineRadio2" value="InActive" {{ $allDepartmentLists->designation_status == 'InActive' ? 'checked':'' }}>
                                                                            <label class="form-check-label" for="inlineRadio2">InActive</label>
                                                                          </div>
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

                                    @if (Auth::guard('admin')->user()->can('designation_delete'))

  <button   type="button" class="btn btn-danger waves-light waves-effect  btn-sm" onclick="deleteTag({{ $allDepartmentLists->id}})" data-toggle="tooltip" title="Delete"><i class="ri-delete-bin-5-fill"></i></button>
  <form id="delete-form-{{ $allDepartmentLists->id }}" action="{{ route('designation.destroy',$allDepartmentLists->id) }}" method="POST" style="display: none;">
    @method('DELETE')
                                  @csrf

                              </form>
                                                  @endif

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

<!-- Default Modals -->
<div id="myModal" class="modal fade" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="myModalLabel">Designation Name</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"> </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('designation.store') }}" method="post" enctype="multipart/form-data" id="form" data-parsley-validate="">
                    @csrf
                    <div class="row">
                        <div class="col-12 mb-2">
                            <label for="" class="form-label">Name</label>
                            <input type="hidden"  name ="admin_id" class="form-control" value="{{ Auth::guard('admin')->user()->id }}" required>
                            <input type="text"  name ="designation_name" class="form-control" maxlength="50" id="" placeholder="Name" required>
                        </div>

                        <div class="col-12 mb-2">
                            <label for="" class="form-label">Department</label>

                            <select  name ="department_id" class="form-control"   required>
                                @foreach($departmentLists as $departmentListsAll)
<option value="{{ $departmentListsAll->id }}">{{ $departmentListsAll->department_name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-12 mb-2">
                            <label for="" class="form-label">Status</label><br>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="designation_status" id="inlineRadio1" value="Active" >
                                <label class="form-check-label" for="inlineRadio1">Active</label>
                              </div>
                              <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="designation_status" id="inlineRadio2" value="InActive">
                                <label class="form-check-label" for="inlineRadio2">InActive</label>
                              </div>
                        </div>
                    <button type="submit" class="btn btn-primary mt-3">Submit</button>
                </form>
            </div>


        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
@endsection


@section('script')

@endsection

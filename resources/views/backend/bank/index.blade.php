@extends('backend.master.master')

@section('title')
Bank List | {{ $ins_name }}
@endsection


@section('body')
<div class="page-content">
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0">Bank List</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Tables</a></li>
                            <li class="breadcrumb-item active">Bank List</li>
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
                        <h4 class="card-title mb-0">Bank Info</h4>
                        @include('flash_message')
                    </div><!-- end card header -->

                    <div class="card-body">
                        <div id="customerList">
                            <div class="row g-4 mb-3">
                                <div class="col-sm-auto">
                                    <div>
                                        <button type="button" class="btn btn-primary add-btn" data-bs-toggle="modal" data-bs-target="#myModal"><i class="ri-add-line align-bottom me-1"></i> Add New Bank Info</button>

                                    </div>
                                </div>

                            </div>

                            <div class="table-responsive table-card mt-3 mb-1">
                                <table id="buttons-datatables" class="display table table-bordered" style="width:100%">
                                    <thead class="table-light">
                                    <tr>
                                        <th class="sort" data-sort="customer_name">Sl</th>

                                        <th class="sort" data-sort="email">Bank Name</th>
                                        <th class="sort" data-sort="email">Branch</th>
                                        <th class="sort" data-sort="email">Account Number</th>
                                        <th class="sort" data-sort="action">Action</th>
                                    </tr>
                                    </thead>
                                    <tbody class="list form-check-all">

                                        @foreach($bankLists as $key=>$allDepartmentLists)
                                    <tr>

                                        <td class="id">{{ $key+1 }}</td>

                                        <td class="customer_name">{{ $allDepartmentLists->bank_name }}</td>
                                        <td class="customer_name">{{ $allDepartmentLists->branch	 }}</td>
                                        <td class="customer_name">{{ $allDepartmentLists->account_number	 }}</td>
                                        <td>



                                            @if (Auth::guard('admin')->user()->can('bank_update'))
                                            <button type="button" data-bs-toggle="modal" data-bs-target=".bs-example-modal-lg{{ $allDepartmentLists->id }}"
                                            class="btn btn-primary waves-light waves-effect  btn-sm" >
                                            <i class="ri-pencil-fill"></i></button>

                                              <!--  Large modal example -->
                                              <div class="modal fade bs-example-modal-lg{{ $allDepartmentLists->id }}" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                                                  <div class="modal-dialog modal-lg">
                                                      <div class="modal-content">
                                                          <div class="modal-header">
                                                              <h5 class="modal-title" id="myLargeModalLabel">Update Bank Info</h5>
                                                              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                                              </button>
                                                          </div>
                                                          <div class="modal-body">
                                                            <form action="{{ route('bank.update',$allDepartmentLists->id) }}" method="post" enctype="multipart/form-data" id="form" data-parsley-validate="">
                                                                @csrf
                                                                @method('PUT')
                                                                <input type="hidden"  name ="admin_id" class="form-control" value="{{ Auth::guard('admin')->user()->id }}" required>
                                                                <div class="row">
                                                                    <div class="col-12 mb-2">
                                                                        <label for="" class="form-label">Bank Name</label>
                                                                        <input type="text" value="{{ $allDepartmentLists->bank_name }}" name ="bank_name" class="form-control" maxlength="50" id="" placeholder="Bank Name" required>
                                                                    </div>

                                                                    <div class="col-12 mb-2">
                                                                        <label for="" class="form-label">Branch</label>
                                                                        <input type="text" value="{{ $allDepartmentLists->branch }}" name ="branch" class="form-control" maxlength="50" id="" placeholder="Branch" required>
                                                                    </div>

                                                                    <div class="col-12 mb-2">
                                                                        <label for="" class="form-label">Account Number</label>
                                                                        <input type="number" value="{{ $allDepartmentLists->account_number }}" name ="account_number" class="form-control" pattern="/^-?\d+\.?\d*$/" onKeyPress="if(this.value.length==20) return false;" placeholder="Account Number" required>
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

                                    @if (Auth::guard('admin')->user()->can('bank_delete'))

  <button   type="button" class="btn btn-danger waves-light waves-effect  btn-sm" onclick="deleteTag({{ $allDepartmentLists->id}})" data-toggle="tooltip" title="Delete"><i class="ri-delete-bin-5-fill"></i></button>
  <form id="delete-form-{{ $allDepartmentLists->id }}" action="{{ route('bank.destroy',$allDepartmentLists->id) }}" method="POST" style="display: none;">
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
                <h5 class="modal-title" id="myModalLabel">Bank Info</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"> </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('bank.store') }}" method="post" enctype="multipart/form-data" id="form" data-parsley-validate="">
                    @csrf
                    <div class="row">
                        <div class="col-12 mb-2">
                            <label for="" class="form-label">Name</label>
                            <input type="hidden"  name ="admin_id" class="form-control" value="{{ Auth::guard('admin')->user()->id }}" required>

                        </div>

                        <div class="col-12 mb-2">
                            <label for="" class="form-label">Bank Name</label>
                            <input type="text"  name ="bank_name" class="form-control" maxlength="50" id="" placeholder="Bank Name" required>
                        </div>

                        <div class="col-12 mb-2">
                            <label for="" class="form-label">Branch</label>
                            <input type="text"  name ="branch" class="form-control" maxlength="50" id="" placeholder="Branch" required>
                        </div>

                        <div class="col-12 mb-2">
                            <label for="" class="form-label">Account Number</label>
                            <input type="number"  name ="account_number" class="form-control" pattern="/^-?\d+\.?\d*$/" onKeyPress="if(this.value.length==20) return false;" placeholder="Account Number" required>
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

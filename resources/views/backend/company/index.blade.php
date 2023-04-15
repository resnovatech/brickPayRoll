@extends('backend.master.master')

@section('title')
Company List | {{ $ins_name }}
@endsection


@section('body')
<div class="page-content">
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0">Company List</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Tables</a></li>
                            <li class="breadcrumb-item active">Company List</li>
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
                        <h4 class="card-title mb-0">Company Info</h4>
                        @include('flash_message')
                    </div><!-- end card header -->

                    <div class="card-body">
                        <div id="customerList">
                            <div class="row g-4 mb-3">
                                <div class="col-sm-auto">
                                    <div>
                                        <button type="button" class="btn btn-primary add-btn" data-bs-toggle="modal" data-bs-target="#myModal"><i class="ri-add-line align-bottom me-1"></i> Add New Company Info</button>

                                    </div>
                                </div>

                            </div>

                            <div class="table-responsive table-card mt-3 mb-1">
                                <table id="buttons-datatables" class="display table table-bordered" style="width:100%">
                                    <thead class="table-light">
                                    <tr>
                                        <th class="sort" data-sort="customer_name">Sl</th>
                                        <th class="sort" data-sort="customer_name"> Company Logo</th>
                                        <th class="sort" data-sort="email">Company Name</th>
                                        <th class="sort" data-sort="email">Company Address</th>
                                        <th class="sort" data-sort="email">Company Phone</th>
                                        <th class="sort" data-sort="action">Action</th>
                                    </tr>
                                    </thead>
                                    <tbody class="list form-check-all">

                                        @foreach($companyList as $key=>$allCompanyList)
                                    <tr>

                                        <td class="id">{{ $key+1 }}</td>
                                        <td class="customer_name">

                                <img style="height:50px;" src="{{ asset('/') }}{{ $allCompanyList->company_logo }}"/>



                                        </td>
                                        <td class="customer_name">{{ $allCompanyList->company_name }}</td>
                                        <td class="customer_name">{{ $allCompanyList->company_address }}</td>
                                        <td class="customer_name">{{ $allCompanyList->company_phone }}</td>
                                        <td>



                                            @if (Auth::guard('admin')->user()->can('company_update'))
                                            <button type="button" data-bs-toggle="modal" data-bs-target=".bs-example-modal-lg{{ $allCompanyList->id }}"
                                            class="btn btn-primary waves-light waves-effect  btn-sm" >
                                            <i class="ri-pencil-fill"></i></button>

                                              <!--  Large modal example -->
                                              <div class="modal fade bs-example-modal-lg{{ $allCompanyList->id }}" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                                                  <div class="modal-dialog modal-lg">
                                                      <div class="modal-content">
                                                          <div class="modal-header">
                                                              <h5 class="modal-title" id="myLargeModalLabel">Update Company Info</h5>
                                                              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                                              </button>
                                                          </div>
                                                          <div class="modal-body">
                                                            <form action="{{ route('company.update',$allCompanyList->id) }}" method="post" enctype="multipart/form-data" id="form" data-parsley-validate="">
                                                                @csrf
                                                                @method('PUT')
                                                                <div class="row">
                                                                    <div class="col-12 mb-2">
                                                                        <label for="" class="form-label">Name</label>
                                                                        <input type="text" value="{{ $allCompanyList->company_name }}" name ="company_name" class="form-control" maxlength="50" id="" placeholder="Name" required>
                                                                    </div>

                                                                    <div class="col-12 mb-2">
                                                                        <label for="" class="form-label">Address</label>
                                                                        <textarea  name ="company_address" class="form-control" id="" placeholder="Address"  maxlength="100" required>{{ $allCompanyList->company_address }}</textarea>
                                                                    </div>

                                                                    <div class="col-12 mb-2">
                                                                        <label for="" class="form-label">Phone</label>
                                                                        <input type="number" value="{{ $allCompanyList->company_phone }}" name ="company_phone" class="form-control" pattern="/^-?\d+\.?\d*$/" onKeyPress="if(this.value.length==20) return false;" placeholder="Phone" required>
                                                                    </div>

                                                                    <div class="col-12 mb-2">
                                                                        <label for="" class="form-label">Logo</label>
                                                                        <input type="file"  name ="company_logo" class="form-control"  >
                                                                        <img style="height:50px;" src="{{ asset('/') }}{{ $allCompanyList->company_logo }}"/>
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

                                    @if (Auth::guard('admin')->user()->can('company_delete'))

  <button   type="button" class="btn btn-danger waves-light waves-effect  btn-sm" onclick="deleteTag({{ $allCompanyList->id}})" data-toggle="tooltip" title="Delete"><i class="ri-delete-bin-5-fill"></i></button>
  <form id="delete-form-{{ $allCompanyList->id }}" action="{{ route('company.destroy',$allCompanyList->id) }}" method="POST" style="display: none;">
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
                <h5 class="modal-title" id="myModalLabel">Company Name</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"> </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('company.store') }}" method="post" enctype="multipart/form-data" id="form" data-parsley-validate="">
                    @csrf
                    <div class="row">
                        <div class="col-12 mb-2">
                            <label for="" class="form-label">Name</label>
                            <input type="text"  name ="company_name" class="form-control" maxlength="50" id="" placeholder="Name" required>
                        </div>

                        <div class="col-12 mb-2">
                            <label for="" class="form-label">Address</label>
                            <textarea  name ="company_address" class="form-control" id="" placeholder="Address"  maxlength="100" required></textarea>
                        </div>

                        <div class="col-12 mb-2">
                            <label for="" class="form-label">Phone</label>
                            <input type="number"  name ="company_phone" class="form-control" pattern="/^-?\d+\.?\d*$/" onKeyPress="if(this.value.length==20) return false;" id="" placeholder="Phone" required>
                        </div>

                        <div class="col-12 mb-2">
                            <label for="" class="form-label">Logo</label>
                            <input type="file"  name ="company_logo" class="form-control"  required>

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

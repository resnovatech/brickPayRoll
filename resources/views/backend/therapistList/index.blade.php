@extends('backend.master.master')

@section('title')
Therapist | {{ $ins_name }}
@endsection


@section('body')
<div class="page-content">
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0">Therapist List</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Tables</a></li>
                            <li class="breadcrumb-item active">Therapist</li>
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
                        <h4 class="card-title mb-0">Therapist Info</h4>
                    </div><!-- end card header -->

                    <div class="card-body">
                        <div id="customerList">
                            <div class="row g-4 mb-3">
                                <div class="col-sm-auto">
                                    <div>
                                        <button type="button" class="btn btn-primary add-btn" data-bs-toggle="modal" data-bs-target="#myModal"><i class="ri-add-line align-bottom me-1"></i> Add New Therapist</button>

                                    </div>
                                </div>

                            </div>

                            <div class="table-responsive table-card mt-3 mb-1">
                                <table id="buttons-datatables" class="display table table-bordered" style="width:100%">
                                    <thead class="table-light">
                                    <tr>
                                        <th class="sort" data-sort="customer_name">Sl</th>
                                        <th class="sort" data-sort="customer_name">Therapist Name</th>
                                        <th class="sort" data-sort="email">Email</th>
                                        <th class="sort" data-sort="email">Phone Number</th>
                                        <th class="sort" data-sort="email">Address</th>
                                        <th class="sort" data-sort="email">NID</th>
                                        <th class="sort" data-sort="email">Nationality</th>
                                        <th class="sort" data-sort="email">DOB</th>
                                        <th class="sort" data-sort="email">Years Of experience</th>
                                        <th class="sort" data-sort="action">Action</th>
                                    </tr>
                                    </thead>
                                    <tbody class="list form-check-all">
                                        @foreach($therapistList as $key=>$allTherapistList)
                                    <tr>

                                        <td class="id">{{ $key+1 }}</td>
                                        <td class="customer_name">{{ $allTherapistList->name }}</td>
                                        <td class="email">{{ $allTherapistList->email }}</td>
                                        <td class="email">{{ $allTherapistList->phone_or_mobile_number }}</td>
                                        <td class="email">{{ $allTherapistList->address }}</td>
                                        <td class="email">{{ $allTherapistList->nid_number }}</td>
                                        <td class="email">{{ $allTherapistList->nationality }}</td>
                                        <td class="email">{{ $allTherapistList->dob }}</td>
                                        <td class="email">{{ $allTherapistList->years_of_experience }}</td>
                                        <td>
                                            @if (Auth::guard('admin')->user()->can('therapistUpdate'))
                                            <button type="button" data-bs-toggle="modal" data-bs-target=".bs-example-modal-lg{{ $allTherapistList->id }}"
                                            class="btn btn-primary waves-light waves-effect  btn-sm" >
                                            <i class="ri-pencil-fill"></i></button>

                                              <!--  Large modal example -->
                                              <div class="modal fade bs-example-modal-lg{{ $allTherapistList->id }}" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                                                  <div class="modal-dialog modal-lg">
                                                      <div class="modal-content">
                                                          <div class="modal-header">
                                                              <h5 class="modal-title" id="myLargeModalLabel">Update Therapist Name</h5>
                                                              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                                              </button>
                                                          </div>
                                                          <div class="modal-body">
                                                            <form action="{{ route('therapist.update',$allTherapistList->id) }}" method="post" enctype="multipart/form-data" id="form" data-parsley-validate="">
                                                                @csrf
                                                                @method('PUT')
                                                                <div class="row">
                                                                    <div class="col-12 mb-2">
                                                                        <label for="" class="form-label">Name</label>
                                                                        <input type="text" class="form-control" value="{{ $allTherapistList->name }}" name="name" id="" placeholder="Name" required>
                                                                    </div>
                                                                    <div class="col-12 mb-2">
                                                                        <label for="" class="form-label">Email</label>
                                                                        <input type="text" class="form-control" value="{{ $allTherapistList->email }}" name="email"  id="" required>
                                                                    </div>
                                                                    <div class="col-12 mb-2">
                                                                        <label for="" class="form-label">Phone Number</label>
                                                                        <input type="text" class="form-control" value="{{ $allTherapistList->phone_or_mobile_number }}" name="phone_or_mobile_number" id="" required>
                                                                    </div>
                                                                    <div class="col-12 mb-2">
                                                                        <label for="" class="form-label">Address</label>
                                                                        <input type="text" class="form-control" value="{{ $allTherapistList->address }}" name="address" id="" required>
                                                                    </div>
                                                                    <div class="col-12 mb-2">
                                                                        <label for="" class="form-label">NID</label>
                                                                        <input type="text" class="form-control" value="{{ $allTherapistList->nid_number }}" name="nid_number" id="" required>
                                                                    </div>
                                                                    <div class="col-12 mb-2">
                                                                        <label for="" class="form-label">Nationality</label>
                                                                        <input type="text" class="form-control" value="{{ $allTherapistList->nationality }}" name="nationality" id="" required>
                                                                    </div>
                                                                    <div class="col-12 mb-2">
                                                                        <label for="" class="form-label">DOB</label>
                                                                        <input type="date" class="form-control" value="{{ $allTherapistList->dob }}"  name="dob" id="" required>
                                                                    </div>
                                                                    <div class="col-12 mb-2">
                                                                        <label for="" class="form-label">Years of experience</label>
                                                                        <input type="text" class="form-control" value="{{ $allTherapistList->years_of_experience }}" name="years_of_experience" id="" required>
                                                                    </div>

                                                                </div>
                                                                <button type="submit" class="btn btn-primary mt-3">Update</button>
                                                            </form>
                                                          </div>
                                                      </div><!-- /.modal-content -->
                                                  </div><!-- /.modal-dialog -->
                                              </div><!-- /.modal -->


  @endif


                                    @if (Auth::guard('admin')->user()->can('therapistDelete'))

  <button   type="button" class="btn btn-danger waves-light waves-effect  btn-sm" onclick="deleteTag({{ $allTherapistList->id}})" data-toggle="tooltip" title="Delete"><i class="ri-delete-bin-5-fill"></i></button>
  <form id="delete-form-{{ $allTherapistList->id }}" action="{{ route('therapist.destroy',$allTherapistList->id) }}" method="POST" style="display: none;">
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

<!-- Default Modals -->
<div id="myModal" class="modal fade" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="myModalLabel">Therapist Name</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"> </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('therapist.store') }}" method="post" enctype="multipart/form-data" id="form" data-parsley-validate="">
                    @csrf
                    <div class="row">
                        <div class="col-12 mb-2">
                            <label for="" class="form-label">Name</label>
                            <input type="text" class="form-control" name="name" id="" placeholder="Name" required>
                        </div>
                        <div class="col-12 mb-2">
                            <label for="" class="form-label">Email</label>
                            <input type="text" class="form-control" name="email"  id="" required>
                        </div>
                        <div class="col-12 mb-2">
                            <label for="" class="form-label">Phone Number</label>
                            <input type="text" class="form-control" name="phone_or_mobile_number" id="" required>
                        </div>
                        <div class="col-12 mb-2">
                            <label for="" class="form-label">Address</label>
                            <input type="text" class="form-control" name="address" id="" required>
                        </div>
                        <div class="col-12 mb-2">
                            <label for="" class="form-label">NID</label>
                            <input type="text" class="form-control" name="nid_number" id="" required>
                        </div>
                        <div class="col-12 mb-2">
                            <label for="" class="form-label">Nationality</label>
                            <input type="text" class="form-control" name="nationality" id="" required>
                        </div>
                        <div class="col-12 mb-2">
                            <label for="" class="form-label">DOB</label>
                            <input type="date" class="form-control" name="dob" id="" required>
                        </div>
                        <div class="col-12 mb-2">
                            <label for="" class="form-label">Years of experience</label>
                            <input type="text" class="form-control" name="years_of_experience" id="" required>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary ">Submit</button>
                </form>
            </div>


        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
@endsection


@section('script')

@endsection

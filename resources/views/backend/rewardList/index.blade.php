@extends('backend.master.master')

@section('title')
Reward  List | {{ $ins_name }}
@endsection


@section('body')
<div class="page-content">
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0">Reward List</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Tables</a></li>
                            <li class="breadcrumb-item active">Reward</li>
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
                        <h4 class="card-title mb-0">Reward Info</h4>
                    </div><!-- end card header -->

                    <div class="card-body">
                        <div id="customerList">
                            <div class="row g-4 mb-3">
                                <div class="col-sm-auto">
                                    <div>
                                        <button type="button" class="btn btn-primary add-btn" data-bs-toggle="modal" data-bs-target="#myModal"><i class="ri-add-line align-bottom me-1"></i> Add New Reward</button>

                                    </div>
                                </div>

                            </div>

                            <div class="table-responsive table-card mt-3 mb-1">
                                <table id="buttons-datatables" class="display table table-bordered" style="width:100%">
                                    <thead class="table-light">
                                    <tr>
                                        <th class="sort" data-sort="customer_name">Sl</th>
                                        <th class="sort" data-sort="customer_name">Reward Name</th>
                                        <th class="sort" data-sort="email">Reward For</th>
                                        <th class="sort" data-sort="email">Reward Point</th>
                                        <th class="sort" data-sort="email">Reward Amount</th>
                                        <th class="sort" data-sort="email">Reward in Exchange</th>
                                        <th class="sort" data-sort="action">Action</th>
                                    </tr>
                                    </thead>
                                    <tbody class="list form-check-all">
                                        @foreach($rewardList as $key=>$allRewardList)
                                    <tr>

                                        <td class="id">{{ $key+1 }}</td>
                                        <td class="customer_name">{{ $allRewardList->name }}</td>
                                        <td class="email">{{ $allRewardList->reward_for }}</td>
                                        <td class="email">{{ $allRewardList->point }}</td>
                                        <td class="email">{{ $allRewardList->amount }}</td>
                                        <td class="email">{{ $allRewardList->in_exchange }}</td>


                                        <td>
                                            @if (Auth::guard('admin')->user()->can('rewardUpdate'))
                                            <button type="button" data-bs-toggle="modal" data-bs-target=".bs-example-modal-lg{{ $allRewardList->id }}"
                                            class="btn btn-primary waves-light waves-effect  btn-sm" >
                                            <i class="ri-pencil-fill"></i></button>

                                              <!--  Large modal example -->
                                              <div class="modal fade bs-example-modal-lg{{ $allRewardList->id }}" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                                                  <div class="modal-dialog modal-lg">
                                                      <div class="modal-content">
                                                          <div class="modal-header">
                                                              <h5 class="modal-title" id="myLargeModalLabel">Update Reward</h5>
                                                              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                                              </button>
                                                          </div>
                                                          <div class="modal-body">
                                                            <form action="{{ route('reward.update',$allRewardList->id) }}" method="post" enctype="multipart/form-data" id="form" data-parsley-validate="">
                                                                @csrf
                                                                @method('PUT')
                                                                <div class="row">

                                                                    <div class="col-12 mb-2">
                                                                        <label for="" class="form-label">Name</label>
                                                                        <input type="text" class="form-control" value="{{ $allRewardList->name }}" name="name" id="" placeholder="Name" required>
                                                                    </div>

                                                                    <div class="col-12 mb-2">
                                                                        <label for="" class="form-label" >Reward For</label>
                                                                        <select name="reward_for" class="form-control" id="" required>
                                                                            <option value="For Product" {{ 'For Product' == $allRewardList->name ? 'selected':''}}>For Product</option>
                                                                            <option value="For Service" {{ 'For Service' == $allRewardList->name ? 'selected':''}}>For Service</option>
                                                                        </select>
                                                                    </div>

                                                                    <div class="col-12 mb-2">
                                                                        <label for="" class="form-label">Point</label>
                                                                        <input type="text" class="form-control" value="{{ $allRewardList->point }}" name="point" id="" required>
                                                                    </div>

                                                                    <div class="col-12 mb-2">
                                                                        <label for="" class="form-label">In Exchange</label>
                                                                        <input type="text" class="form-control" value="{{ $allRewardList->in_exchange }}" name="in_exchange" id="" required>
                                                                    </div>

                                                                    <div class="col-12 mb-2">
                                                                        <label for="" class="form-label">Amount</label>
                                                                        <input type="text" class="form-control" value="{{ $allRewardList->amount }}" name="amount" id="" required>
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

  <button   type="button" class="btn btn-danger waves-light waves-effect  btn-sm" onclick="deleteTag({{ $allRewardList->id}})" data-toggle="tooltip" title="Delete"><i class="ri-delete-bin-5-fill"></i></button>
  <form id="delete-form-{{ $allRewardList->id }}" action="{{ route('reward.destroy',$allRewardList->id) }}" method="POST" style="display: none;">
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
                <h5 class="modal-title" id="myModalLabel">Reward Name</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"> </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('reward.store') }}" method="post" enctype="multipart/form-data" id="form" data-parsley-validate="">
                    @csrf
                    <div class="row">
                        <div class="col-12 mb-2">
                            <label for="" class="form-label">Name</label>
                            <input type="text" class="form-control"  name="name" id="" placeholder="Name" required>
                        </div>

                        <div class="col-12 mb-2">
                            <label for="" class="form-label" >Reward For</label>
                            <select name="reward_for" class="form-control" id="" required>
                                <option value="For Product">For Product</option>
                                <option value="For Service">For Service</option>
                            </select>
                        </div>

                        <div class="col-12 mb-2">
                            <label for="" class="form-label">Point</label>
                            <input type="text" class="form-control"  name="point" id="" required>
                        </div>

                        <div class="col-12 mb-2">
                            <label for="" class="form-label">In Exchange</label>
                            <input type="text" class="form-control"  name="in_exchange" id="" required>
                        </div>

                        <div class="col-12 mb-2">
                            <label for="" class="form-label">Amount</label>
                            <input type="text" class="form-control" name="amount" id="" required>
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

